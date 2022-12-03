<template>
	<div>
		<div
			class="w-full hidden md:flex items-center justify-between text-xs p-1 sm:px-6 md:px-6 lg:px-20"
		>
			<div class="w-full flex items-center justify-start space-x-1">
				<span>{{ $t("text-welcome-to") }}</span>
				<nuxt-link
					:href="siteSettings.locationPath"
					class="font-bold hover:underline"
					>{{ siteSettings.textUrl }}</nuxt-link
				>
			</div>
			<div class="w-full flex items-center justify-end space-x-3">
				<SiteSettingsLanguageChange class="" />
				<SiteSettingsColorChange />
			</div>
		</div>
		<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->

		<!-- <OffCanvasSidebar class="sticky w-full top-0 block md:hidden drop-shadow" /> -->
		<LayoutsLandingNavDrawer :siteSettings="siteSettings" id="NavDrawer" />

		<LayoutsLandingHeader
			class="sticky w-full hidden md:block top-0 drop-shadow z-50 border-t border-b border-gray-300 dark:border-gray-700"
			:siteSettings="siteSettings"
			id="Navebar"
		/>

		<div class="flex flex-col mt-14 sm:mt-20 md:mt-0">
			<main class="min-h-screen px-5 sm:px-8 md:px-10 lg:px-20 py-10">
				<!-- <div
					class="max-w-7xl px-3 sm:px-6 md:px-10 lg:px-20 py-6 text-black dark:text-white"
				> -->
				<slot />
			</main>

			<LayoutsLandingFooter :siteSettings="siteSettings" />
		</div>
	</div>
</template>

<script script lang="ts">
	import { siteSettings } from "~/settings/site";

	definePageMeta({
		layout: "landing",
	});

	export default defineComponent({
		components: {
			//
		},
		setup() {
			return {
				siteSettings,
			};
		},
	});
</script>

<style></style>
