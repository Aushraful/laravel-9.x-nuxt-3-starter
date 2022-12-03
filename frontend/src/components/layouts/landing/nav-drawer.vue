<template>
	<div class="md:hidden">
		<div class="relative z-40 bg-white" role="dialog" aria-modal="true">
			<div
				class="fixed h-16 sm:h-20 flex items-center bg-white dark:bg-gray-800 justify-between w-screen top-0 p-3 sm:p-6 shadow"
			>
				<NuxtLink to="/">
					<img
						:src="siteSettings.shortLogo.src"
						:alt="siteSettings.shortLogo.alt"
						class="w-[30px] h-[30px]"
					/>
				</NuxtLink>

				<button
					type="button"
					@click="navDrawerOpen = true"
					class="px-4 text-gray-500 focus:outline-none focus:ring-0 bg-transparent focus:bg-transparent active:bg-transparent"
				>
					<span class="sr-only">Open sidebar</span>
					<!-- Heroicon name: outline/menu-alt-2 -->
					<svg
						class="h-6 w-6"
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 24 24"
						stroke-width="2"
						stroke="currentColor"
						aria-hidden="true"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							d="M4 6h16M4 12h16M4 18h7"
						/>
					</svg>
				</button>
			</div>

			<TransitionRoot as="template" :show="navDrawerOpen" class="z-40">
				<Dialog as="div" class="relative z-10" @close="navDrawerOpen = false">
					<TransitionChild
						as="template"
						enter="ease-in-out duration-500"
						enter-from="opacity-0"
						enter-to="opacity-100"
						leave="ease-in-out duration-500"
						leave-from="opacity-100"
						leave-to="opacity-0"
					>
						<div
							class="fixed inset-0 bg-gray-800 bg-opacity-75 transition-opacity"
						/>
					</TransitionChild>

					<div class="fixed inset-0 overflow-hidden">
						<div class="absolute inset-0 overflow-hidden">
							<div class="pointer-events-none fixed inset-y-0 left-0 flex w-64">
								<TransitionChild
									as="template"
									enter="transform transition ease-in-out duration-500 sm:duration-700"
									enter-from="-translate-x-full"
									enter-to="-translate-x-0"
									leave="transform transition ease-in-out duration-500 sm:duration-700"
									leave-from="-translate-x-0"
									leave-to="-translate-x-full"
								>
									<DialogPanel class="pointer-events-auto w-screen max-w-md">
										<div
											class="flex h-full flex-col overflow-y-scroll bg-white dark:bg-gray-800 py-6 shadow-xl"
										>
											<div class="px-4 sm:px-6">
												<div class="flex items-start justify-between">
													<DialogTitle class="text-lg font-medium text-gray-900"
														><NuxtLink to="/">
															<img
																:src="siteSettings.logo.src"
																style="width: 170px; height: 30px"
															/> </NuxtLink
													></DialogTitle>
													<div
														class="absolute right-0 -mr-12 flex h-7 items-center"
													>
														<button
															type="button"
															class="rounded-md border text-gray-300 hover:text-gray-500 focus:outline-none"
															@click="navDrawerOpen = false"
														>
															<span class="sr-only">Close panel</span>
															<XMarkIcon class="h-6 w-6" aria-hidden="true" />
														</button>
													</div>
												</div>
											</div>

											<div class="mt-5 flex-1 h-0 overflow-y-auto">
												<nav class="px-2 space-y-1 text-xs">
													<template v-for="item in navigation" :key="item.name">
														<div v-if="!item.children">
															<a
																href="#"
																:class="[
																	item.current
																		? 'bg-gray-200 dark:bg-gray-900'
																		: '',
																	' text-black dark:text-white group w-full flex items-center px-2 py-2 font-medium rounded-md',
																]"
															>
																<component
																	:is="item.icon"
																	:class="[
																		item.current ? '' : '',
																		'text-black dark:text-white mr-4 flex-shrink-0 h-4 w-4',
																	]"
																	aria-hidden="true"
																/>
																{{ item.name }}
															</a>
														</div>
														<Disclosure
															as="div"
															v-else
															class="space-y-1"
															v-slot="{ open }"
														>
															<DisclosureButton
																:class="[
																	item.current
																		? 'bg-gray-200 dark:bg-gray-900'
																		: '',
																	' text-black dark:text-white group w-full flex items-center px-2 py-2 font-medium rounded-md',
																]"
															>
																<component
																	:is="item.icon"
																	:class="[
																		item.current ? '' : '',
																		' text-black dark:text-white mr-4 flex-shrink-0 h-4 w-4',
																	]"
																	aria-hidden="true"
																/>
																<span>{{ item.name }}</span>
																<svg
																	:class="[
																		open
																			? 'text-gray-400 rotate-90'
																			: 'text-gray-300',
																		'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400',
																	]"
																	viewBox="0 0 20 20"
																	aria-hidden="true"
																>
																	<path
																		d="M6 6L14 10L6 14V6Z"
																		fill="currentColor"
																	/>
																</svg>
															</DisclosureButton>
															<DisclosurePanel class="space-y-1">
																<DisclosureButton
																	v-for="subItem in item.children"
																	:key="subItem.name"
																	as="a"
																	:href="subItem.href"
																	class="group flex w-full items-center rounded-md py-2 pl-11 pr-2 text-black dark:text-white hover:bg-gray-700"
																	>{{ subItem.name }}</DisclosureButton
																>
															</DisclosurePanel>
														</Disclosure>
													</template>
													<template
														v-if="!isLoggedIn"
														v-for="item in guest_navigation"
														:key="item.name"
													>
														<div v-if="!item.children">
															<a
																href="#"
																:class="[
																	item.current
																		? 'bg-gray-200 dark:bg-gray-900'
																		: '',
																	' text-black dark:text-white group w-full flex items-center px-2 py-2 font-medium rounded-md',
																]"
															>
																<component
																	:is="item.icon"
																	:class="[
																		item.current ? '' : '',
																		'text-black dark:text-white mr-4 flex-shrink-0 h-4 w-4',
																	]"
																	aria-hidden="true"
																/>
																{{ item.name }}
															</a>
														</div>
														<Disclosure
															as="div"
															v-else
															class="space-y-1"
															v-slot="{ open }"
														>
															<DisclosureButton
																:class="[
																	item.current
																		? 'bg-gray-200 dark:bg-gray-900'
																		: '',
																	' text-black dark:text-white group w-full flex items-center px-2 py-2 font-medium rounded-md',
																]"
															>
																<component
																	:is="item.icon"
																	:class="[
																		item.current ? '' : '',
																		' text-black dark:text-white mr-4 flex-shrink-0 h-4 w-4',
																	]"
																	aria-hidden="true"
																/>
																<span>{{ item.name }}</span>
																<svg
																	:class="[
																		open
																			? 'text-gray-400 rotate-90'
																			: 'text-gray-300',
																		'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400',
																	]"
																	viewBox="0 0 20 20"
																	aria-hidden="true"
																>
																	<path
																		d="M6 6L14 10L6 14V6Z"
																		fill="currentColor"
																	/>
																</svg>
															</DisclosureButton>
															<DisclosurePanel class="space-y-1">
																<DisclosureButton
																	v-for="subItem in item.children"
																	:key="subItem.name"
																	as="a"
																	:href="subItem.href"
																	class="group flex w-full items-center rounded-md py-2 pl-11 pr-2 text-black dark:text-white hover:bg-gray-700"
																	>{{ subItem.name }}</DisclosureButton
																>
															</DisclosurePanel>
														</Disclosure>
													</template>
													<template
														v-if="isLoggedIn"
														v-for="item in protected_navigation"
														:key="item.name"
													>
														<div v-if="!item.children">
															<a
																href="#"
																:class="[
																	item.current
																		? 'bg-gray-200 dark:bg-gray-900'
																		: '',
																	' text-black dark:text-white group w-full flex items-center px-2 py-2 font-medium rounded-md',
																]"
															>
																<component
																	:is="item.icon"
																	:class="[
																		item.current ? '' : '',
																		'text-black dark:text-white mr-4 flex-shrink-0 h-4 w-4',
																	]"
																	aria-hidden="true"
																/>
																{{ item.name }}
															</a>
														</div>
														<Disclosure
															as="div"
															v-else
															class="space-y-1"
															v-slot="{ open }"
														>
															<DisclosureButton
																:class="[
																	item.current
																		? 'bg-gray-200 dark:bg-gray-900'
																		: '',
																	' text-black dark:text-white group w-full flex items-center px-2 py-2 font-medium rounded-md',
																]"
															>
																<component
																	:is="item.icon"
																	:class="[
																		item.current ? '' : '',
																		' text-black dark:text-white mr-4 flex-shrink-0 h-4 w-4',
																	]"
																	aria-hidden="true"
																/>
																<span>{{ item.name }}</span>
																<svg
																	:class="[
																		open
																			? 'text-gray-400 rotate-90'
																			: 'text-gray-300',
																		'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400',
																	]"
																	viewBox="0 0 20 20"
																	aria-hidden="true"
																>
																	<path
																		d="M6 6L14 10L6 14V6Z"
																		fill="currentColor"
																	/>
																</svg>
															</DisclosureButton>
															<DisclosurePanel class="space-y-1">
																<DisclosureButton
																	v-for="subItem in item.children"
																	:key="subItem.name"
																	as="a"
																	:href="subItem.href"
																	@click="subItem.action"
																	class="group flex w-full items-center rounded-md py-2 pl-11 pr-2 text-black dark:text-white hover:bg-gray-700"
																	>{{ subItem.name }}</DisclosureButton
																>
															</DisclosurePanel>
														</Disclosure>
													</template>
												</nav>
											</div>
											<div class="mt-auto">
												<div class="flex justify-between mx-5">
													<SiteSettingsLanguageChange />
													<SiteSettingsColorChange />
													<button
														v-if="isLoggedIn"
														class="flex items-center justify-center rounded-lg border border-black hover:text-cyan-500 hover:border-cyan-500 px-1"
														@click="logout"
													>
														<Icon name="vaadin:power-off" />
													</button>
												</div>
											</div>
										</div>
									</DialogPanel>
								</TransitionChild>
							</div>
						</div>
					</div>
				</Dialog>
			</TransitionRoot>
		</div>
	</div>
</template>

<script script lang="ts">
	definePageMeta({
		layout: "landing",
	});

	import { ref } from "vue";

	import {
		Disclosure,
		DisclosureButton,
		DisclosurePanel,
	} from "@headlessui/vue";

	import {
		FolderIcon,
		HomeIcon,
		InboxIcon,
		UserIcon,
	} from "@heroicons/vue/24/outline";

	import {
		Dialog,
		DialogPanel,
		DialogTitle,
		TransitionChild,
		TransitionRoot,
	} from "@headlessui/vue";
	import { XMarkIcon } from "@heroicons/vue/24/outline";

	export default defineComponent({
		components: {
			Disclosure,
			DisclosureButton,
			DisclosurePanel,

			Dialog,
			DialogPanel,
			DialogTitle,
			TransitionChild,
			TransitionRoot,
			XMarkIcon,
		},

		methods: {
			// changeState: function (event) {
			//     offCanvasSidebarStore.$state = true;
			// }
		},

		props: ["siteSettings"],
	});
</script>

<script setup lang="ts">
	import { useLoggedIn, useLogout } from "~/composables/useAuth";
	import { Routes } from "@/config/routes";

	const logout = useLogout;
	const router = useRouter();

	const user = useState("user");

	const initalCheck = await useLoggedIn();
	const isLoggedIn = ref(initalCheck);

	async function checkIfLoggedIn() {
		const check = await useLoggedIn();
		isLoggedIn.value = check;
	}

	watch(
		user,
		async () => {
			await checkIfLoggedIn();
		},
		{ deep: true }
	);

	const navigation = [
		{ name: "Home", icon: HomeIcon, current: true, href: "#", action: null },
	];

	const guest_navigation = [
		{
			name: "Account",
			icon: UserIcon,
			current: false,
			children: [
				{ name: "Sign in", href: Routes.login, action: null },
				{ name: "Sign up", href: Routes.register, action: null },
			],
		},
	];

	const protected_navigation = [
		{
			name: "Account",
			icon: UserIcon,
			current: false,
			children: [
				{ name: "Profile", href: Routes.profile, action: null },
				{ name: "Sign out", href: "#", action: logout },
			],
		},
	];

	const navDrawerOpen = ref(false);
</script>
