<script>
  import Header from '../shared/Header.svelte';
  import Footer from '../shared/Footer.svelte';

  export let title;
  export let site_name;
  export let header;
  export let footer;

  $: pageTitle = `${title} - ${site_name}`;
</script>

<svelte:head>
  <title>
    {pageTitle}
  </title>
</svelte:head>

<Header {...header} />

<main>
  <slot />
</main>

<Footer {...footer} />
