<script lang="ts" setup>
	import { useUser } from "~/composables/useAuth";
	import { useI18n } from "vue-i18n";

	const { locale } = useI18n();

	const nuxtApp = useNuxtApp();

	nuxtApp.hook("page:finish", () => {
		window.scrollTo(0, 0);
	});

	await useUser();
</script>

<template>
	<!-- <div class="dark:bg-slate-800 min-h-screen dark:text-white">
		<NuxtPage />
	</div> -->
	<Html :lang="locale">
		<Body
			class="bg-gray-200 text-gray-800 antialiased transition-colors duration-300 dark:bg-gray-900 dark:text-gray-200"
		>
			<NuxtLayout>
				<NuxtPage />
			</NuxtLayout>
		</Body>
	</Html>
</template>
