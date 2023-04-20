<script>
  import { inertia, page } from '@inertiajs/svelte';

  export let menu;
</script>

<header>
  <div class="container">
    <div class="navbar">
      <div class="navbar-brand">
        <a class="navbar-item" href={$page.props.home_url} use:inertia>
          <span>Home</span>
        </a>
      </div>
      {#if menu}
        <nav class="navbar-menu" aria-label="main navigation">
          <ul class="navbar-start">
            {#each menu as item (item.id)}
              <li class="navbar-item">
                <a href={item.url} use:inertia
                  >{item.title}</a
                >
              </li>
            {/each}
          </ul>
        </nav>
      {/if}
    </div>
  </div>
</header>
