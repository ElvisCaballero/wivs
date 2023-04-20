import fs from 'fs';

const hotFile = 'public/hot';

export default function wordpress() {
  return {
    name: 'wordpress',
    config: (userConfig, { command, mode }) => {
      return {
        base: userConfig.base ?? '/app/themes/base/public/',
        build: {
          manifest: userConfig.build?.manifest ?? true,
          outDir: userConfig.build?.outDir ?? 'dist',
          rollupOptions: {
            input: userConfig.build?.rollupOptions?.input ?? '/src/js/app.js',
          },
        },
      };
    },
    configureServer(server) {
      server.httpServer?.once('listening', () => {
        if ('development' == server.config.mode) {
          const address = server.httpServer?.address();
          const viteDevServerUrl = resolveDevServerUrl(address, server.config);
          fs.writeFileSync(hotFile, viteDevServerUrl);
        }
      });

      const clean = () => {
        if (fs.existsSync(hotFile)) {
          fs.rmSync(hotFile);
        }
      };

      process.on('exit', clean);
      process.on('SIGINT', process.exit);
      process.on('SIGTERM', process.exit);
      process.on('SIGHUP', process.exit);

      return () =>
        server.middlewares.use((req, res, next) => {
          next();
        });
    },
  };
}

/**
 * Resolve the dev server URL from the server address and configuration.
 */
function resolveDevServerUrl(address, config) {
  const configHmrProtocol =
    typeof config.server.hmr === 'object' ? config.server.hmr.protocol : null;
  const clientProtocol = configHmrProtocol
    ? configHmrProtocol === 'wss'
      ? 'https'
      : 'http'
    : null;
  const serverProtocol = config.server.https ? 'https' : 'http';
  const protocol = clientProtocol ?? serverProtocol;

  const configHmrHost =
    typeof config.server.hmr === 'object' ? config.server.hmr.host : null;
  const configHost =
    typeof config.server.host === 'string' ? config.server.host : null;
  const serverAddress = isIpv6(address)
    ? `[${address.address}]`
    : address.address;
  const host = configHmrHost ?? configHost ?? serverAddress;

  const configHmrClientPort =
    typeof config.server.hmr === 'object' ? config.server.hmr.clientPort : null;
  const port = configHmrClientPort ?? address.port;

  return `${protocol}://${host}:${port}`;
}

function isIpv6(address) {
  return (
    address.family === 'IPv6' ||
    // In node >=18.0 <18.4 this was an integer value. This was changed in a minor version.
    // See: https://github.com/laravel/vite-plugin/issues/103
    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore-next-line
    address.family === 6
  );
}
