<script>
  import { useForm, page } from '@inertiajs/svelte';

  $: i18n = $page.props.i18n;

  const form = useForm({
    first_name: '',
    email: '',
  });

  function handleSubmit() {
    $form.clearErrors();

    // Rest endpoint in WP
    const url = $page.props.ajax_url + '/wivs/contacts';

    $form.post(url, {
      preserveScroll: true,
      onSuccess: () => {
        $form.reset();
      },
    });
  }
</script>

<form class="box" on:submit|preventDefault={handleSubmit}>
  <div class="field">
    <label class="label" for="cf-fist-name">{i18n.page.first_name}</label>
    <input
      id="cf-fist-name"
      class="input"
      class:is-danger={$form.errors.first_name}
      type="text"
      bind:value={$form.first_name}
    />
    {#if $form.errors.first_name}
      <p class="help is-danger">{$form.errors.first_name}</p>
    {/if}
  </div>

  <div class="field">
    <label class="label" for="cf-email">{i18n.page.email}</label>
    <input
      id="cf-email"
      class="input"
      class:is-danger={$form.errors.email}
      type="email"
      bind:value={$form.email}
    />
    {#if $form.errors.email}
      <p class="help is-danger">{$form.errors.email}</p>
    {/if}
  </div>

  <button
    class="button is-primary is-outlined"
    class:is-loading={$form.processing}
    type="submit">{i18n.page.submit}</button
  >
</form>
