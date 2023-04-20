<script>
  import PageHeader from '$lib/PageHeader.svelte';
  import ContactForm from '$lib/Contact/Form.svelte';

  export let title;
</script>

<PageHeader {title} />
<section class="section">
  <div class="container">
    <ContactForm />
  </div>
</section>
