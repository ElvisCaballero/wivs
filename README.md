# WordPress theme using Inertia.js Vite and Svelte

This theme is made utilizing [WordPress Adapter](https://github.com/boxybird/inertia-wordpress)

To make it work in Vite I have taken inspiration from [Laravel Vite Plugin](https://github.com/laravel/vite-plugin)

Theme uses [Inertia.js](https://inertiajs.com/) [Vite](https://vitejs.dev/) and [Svelte](https://svelte.dev/)

## Local env
I have only tested this on [Bedrock](https://roots.io/bedrock/) for default WordPress instalations please change base path in `vite.config.js` to `/wp-content/themes/base/public`
```javascript
export default defineConfig({
  base: '/wp-content/themes/base/public',
  ...
});
```

# Getting started
Before continuing [Composer](https://getcomposer.org/) and [Node](https://nodejs.org/en) is required.

**Current theme setup expects you use localhost as local site address.**

Install theme required packages
```
composer install
```

Install node modules
```
npm install
```

For theme layout development run
```
npm run dev
```

To build assets for production
```
npm run build
```
