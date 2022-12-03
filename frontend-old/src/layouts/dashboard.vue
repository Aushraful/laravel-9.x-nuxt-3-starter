<template>
  <div>
  <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
  <OffCanvasSidebar />

  <!-- Static sidebar for desktop -->
  <Sidebar />
  
  <div class="md:pl-64 flex flex-col">
    <Header />

    <main class="flex-1">
      <div class="py-6">
        <slot />
      </div>
    </main>
  </div>
</div>
</template>

<script setup>
import Sidebar from '~/components/layouts/dashboard-partials/sidebar.vue';
import OffCanvasSidebar from '~/components/layouts/dashboard-partials/off-canvas-sidebar.vue';
import Header from '~/components/layouts/dashboard-partials/header.vue';</script>

<style></style>