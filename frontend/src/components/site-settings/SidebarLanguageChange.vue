<script lang="ts" setup>
	import {
		Listbox,
		ListboxButton,
		ListboxLabel,
		ListboxOptions,
	} from "@headlessui/vue";
	import { useI18n } from "vue-i18n";
	// import { availableLocales } from "~/locales/availableLocales";
	import { siteSettings } from "~~/src/settings/site";

	const availableLocales = siteSettings.locales;

	const switchLocalePath = useSwitchLocalePath();

	const { locale } = useI18n();

	const local = computed(() => {
		return locale.value;
	});
</script>

<template>
	<div>
		<Listbox v-model="local" as="div" class="relative flex items-center">
			<ListboxLabel class="sr-only"> Change Language </ListboxLabel>
			<ListboxButton type="button" title="Change Language">
				<!-- <div
					class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-700"
				>
					<UnoIcon class="i-ph-translate-bold text-lg dark:text-white" />
				</div> -->
				<div
					class="flex items-center justify-center rounded-lg border border-black hover:text-cyan-500 hover:border-cyan-500 px-1"
				>
					<UnoIcon class="i-ph-translate-bold" />
					<span class="pl-1">{{ local }}</span>
				</div>
			</ListboxButton>
			<ListboxOptions
				class="absolute bottom-full z-[999] p-1 border dark:border-gray-600 mt-2 w-40 overflow-hidden rounded-lg bg-white text-sm font-semibold text-gray-700 shadow-lg shadow-gray-300 outline-none dark:bg-gray-800 dark:text-white dark:shadow-gray-500 dark:ring-0"
			>
				<NuxtLink
					v-for="lang in availableLocales"
					:key="lang.iso"
					:to="switchLocalePath(lang.iso)"
					class="flex w-full cursor-pointer items-center justify-between py-2 px-3 rounded"
					:class="{
						'text-white bg-cyan-500 dark:text-white dark:bg-cyan-500/50':
							local === lang.iso,
						'hover:bg-cyan-200 dark:hover:bg-cyan-700/30': local !== lang.iso,
					}"
				>
					<span class="truncate">
						{{ lang.name }}
					</span>
					<span class="flex items-center justify-center text-sm">
						<UnoIcon :class="lang.flag" class="text-base" />
					</span>
				</NuxtLink>
			</ListboxOptions>
		</Listbox>
	</div>
</template>
