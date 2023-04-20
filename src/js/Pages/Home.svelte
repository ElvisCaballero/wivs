<script>
  export let about;
</script>

<section class="section">
  <div class="container">
    <h1 class="title">Hero</h1>
  </div>
</section>
{#if about}
  <section class="section">
    <div class="container">
      <h2 class="title">{about.title}</h2>
      <p>{about.desc}</p>
    </div>
  </section>
{/if}
