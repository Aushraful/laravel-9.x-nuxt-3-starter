<template>
	<div class="">
		<div
			class="flex sticky top-0 z-10 flex-shrink-0 bg-white dark:bg-gray-800 shadow p-3 sm:px-6 md:px-6 lg:px-6"
		>
			<div class="flex-1 flex justify-between items-center">
				<NuxtLink to="/">
					<img
						:src="siteSettings.logo.src"
						:alt="siteSettings.logo.alt"
						class="w-[170px] h-[30px]"
					/>
				</NuxtLink>
				<div class="ml-4 flex items-center md:ml-6 space-x-3">
					<div>
						<div class="w-full flex items-center justify-end space-x-3">
							<SiteSettingsLanguageChange class="" />
							<SiteSettingsColorChange />
						</div>
					</div>
					<!-- Profile dropdown -->
					<Menu as="div" class="relative inline-block">
						<div>
							<MenuButton
								class="inline-flex w-full justify-center rounded-full focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
							>
								<span class="sr-only">Open user menu</span>
								<img
									v-if="user?.avatar"
									class="h-8 w-8 rounded-full"
									src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
									alt=""
								/>

								<Icon v-else name="carbon:user-avatar" class="w-8 h-8" />
							</MenuButton>
							<!-- {{ user?.data?.email }} -->
						</div>

						<transition
							enter-active-class="transition duration-100 ease-out"
							enter-from-class="transform scale-95 opacity-0"
							enter-to-class="transform scale-100 opacity-100"
							leave-active-class="transition duration-75 ease-in"
							leave-from-class="transform scale-100 opacity-100"
							leave-to-class="transform scale-95 opacity-0"
						>
							<MenuItems
								v-if="isLoggedIn"
								class="absolute right-0 mt-2 w-56 origin-top-right divide-y border dark:border-gray-600 divide-gray-100 dark:divide-gray-600 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
							>
								<div class="px-1 py-1">
									<MenuItem v-slot="{ active }">
										<NuxtLink
											:to="Routes.profile"
											:class="[
												active ? 'bg-cyan-500 text-white' : 'text-gray-900',
												'group flex w-full items-center rounded-md px-2 py-2 text-sm dark:text-white',
											]"
										>
											<UiIconsProfile
												:active="active"
												:class="[
													active ? 'text-gray-100' : 'text-gray-500',
													'dark:text-white',
												]"
												class="mr-2 h-4 w-4"
												aria-hidden="true"
											/>
											{{ $t("text-profile") }}
										</NuxtLink>
									</MenuItem>
									<MenuItem v-slot="{ active }">
										<button
											:class="[
												active ? 'bg-cyan-500 text-white' : 'text-gray-900',
												'group flex w-full items-center rounded-md px-2 py-2 text-sm dark:text-white',
											]"
										>
											<UiIconsSettings
												:active="active"
												:class="[
													active ? 'text-gray-100' : 'text-gray-500',
													'dark:text-white',
												]"
												class="mr-2 h-4 w-4"
												aria-hidden="true"
											/>
											{{ $t("text-settings") }}
										</button>
									</MenuItem>
								</div>

								<div class="px-1 py-1">
									<MenuItem v-slot="{ active }">
										<button
											:class="[
												active ? 'bg-cyan-500 text-white' : 'text-gray-900',
												'group flex w-full items-center rounded-md px-2 py-2 text-sm dark:text-white',
											]"
											@click="logout"
										>
											<UiIconsLogout
												:active="active"
												:class="[
													active ? 'text-gray-100' : 'text-gray-500',
													'dark:text-white',
												]"
												class="mr-2 h-4 w-4"
												aria-hidden="true"
											/>
											{{ $t("text-log-out") }}
										</button>
									</MenuItem>
								</div>
							</MenuItems>

							<MenuItems
								v-else
								class="absolute right-0 mt-2 w-56 origin-top-right divide-y border dark:border-gray-600 divide-gray-100 dark:divide-gray-600 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
							>
								<div class="px-1 py-1">
									<MenuItem v-slot="{ active }">
										<NuxtLink
											:to="Routes.login"
											:class="[
												active ? 'bg-cyan-500 text-white' : 'text-gray-900',
												'group flex w-full items-center rounded-md px-2 py-2 text-sm dark:text-white',
											]"
										>
											<Icon
												name="entypo:login"
												:active="active"
												:class="[
													active ? 'text-gray-100' : 'text-gray-500',
													'dark:text-white',
												]"
												class="mr-2 h-4 w-4"
												aria-hidden="true"
											/>
											{{ $t("text-log-in") }}
										</NuxtLink>
									</MenuItem>
								</div>
								<div class="px-1 py-1">
									<MenuItem v-slot="{ active }">
										<NuxtLink
											:to="Routes.register"
											:class="[
												active ? 'bg-cyan-500 text-white' : 'text-gray-900',
												'group flex w-full items-center rounded-md px-2 py-2 text-sm dark:text-white',
											]"
										>
											<UiIconsRegister
												:active="active"
												:class="[
													active ? 'text-gray-100' : 'text-gray-500',
													'dark:text-white',
												]"
												class="mr-2 h-4 w-4"
												aria-hidden="true"
											/>
											{{ $t("text-register") }}
										</NuxtLink>
									</MenuItem>
								</div>
							</MenuItems>
						</transition>
					</Menu>
				</div>
			</div>
		</div>
	</div>
</template>

<script script lang="ts">
	import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
	export default defineComponent({
		components: {
			Menu,
			MenuButton,
			MenuItems,
			MenuItem,
		},
		methods: {
			//
		},
		props: ["siteSettings"],
	});

	definePageMeta({
		layout: "dashboard",
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
</script>
