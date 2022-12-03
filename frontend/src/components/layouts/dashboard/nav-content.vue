<template>
	<div class="flex h-full flex-col overflow-y-auto">
		<div class="mt-5 flex-1 h-0 overflow-y-auto">
			<nav class="px-2 space-y-1 text-xs">
				<template v-for="item in navigation" :key="item.name">
					<div v-if="!item.children">
						<a
							href="#"
							:class="[
								item.current ? 'bg-gray-200 dark:bg-gray-900' : '',
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
					<Disclosure as="div" v-else class="space-y-1" v-slot="{ open }">
						<DisclosureButton
							:class="[
								item.current ? 'bg-gray-200 dark:bg-gray-900' : '',
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
									open ? 'text-gray-400 rotate-90' : 'text-gray-300',
									'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400',
								]"
								viewBox="0 0 20 20"
								aria-hidden="true"
							>
								<path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
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
								item.current ? 'bg-gray-200 dark:bg-gray-900' : '',
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
					<Disclosure as="div" v-else class="space-y-1" v-slot="{ open }">
						<DisclosureButton
							:class="[
								item.current ? 'bg-gray-200 dark:bg-gray-900' : '',
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
									open ? 'text-gray-400 rotate-90' : 'text-gray-300',
									'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400',
								]"
								viewBox="0 0 20 20"
								aria-hidden="true"
							>
								<path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
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
								item.current ? 'bg-gray-200 dark:bg-gray-900' : '',
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
					<Disclosure as="div" v-else class="space-y-1" v-slot="{ open }">
						<DisclosureButton
							:class="[
								item.current ? 'bg-gray-200 dark:bg-gray-900' : '',
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
									open ? 'text-gray-400 rotate-90' : 'text-gray-300',
									'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400',
								]"
								viewBox="0 0 20 20"
								aria-hidden="true"
							>
								<path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
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
	</div>
</template>

<script script lang="ts">
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

	export default defineComponent({
		components: {
			Disclosure,
			DisclosureButton,
			DisclosurePanel,
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
