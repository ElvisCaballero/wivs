import autoprefixer from 'autoprefixer';
import sveltePreprocess from 'svelte-preprocess';

export default {
  preprocess: sveltePreprocess({
    scss: {
      prependData: `@import 'src/styles/config.scss';`,
    },
    postcss: {
      plugins: [autoprefixer],
    },
  }),
};
