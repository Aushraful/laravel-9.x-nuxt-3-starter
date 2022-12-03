<template>
	<div>
		<div
			class="w-full hidden md:flex items-center justify-between text-xs p-1 sm:px-6 md:px-6 lg:px-6"
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
		<LayoutsDashboardNavDrawer :siteSettings="siteSettings" />

		<!-- <div class="md:pl-64 flex flex-col"> -->
		<div class="w-screen flex flex-col">
			<!-- <Header /> -->
			<LayoutsDashboardHeader
				class="sticky w-full hidden md:block top-0 drop-shadow z-50 border-t border-b border-gray-300 dark:border-gray-700"
				:siteSettings="siteSettings"
				id="Navebar"
			/>
			<main class="flex-1">
				<!-- Static sidebar for desktop -->
				<LayoutsDashboardSidebar
					:siteSettings="siteSettings"
					class="h-screen w-64 fixed overflow-y-auto bg-white dark:bg-gray-800"
				/>
				<div class="md:pl-64 py-6">
					<slot />
				</div>
			</main>
		</div>
	</div>
</template>

<script script lang="ts">
	import { siteSettings } from "~/settings/site";

	definePageMeta({
		layout: "dashboard",
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
