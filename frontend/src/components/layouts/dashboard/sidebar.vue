<template>
	<div class="w-full hidden md:block">
		<div class="relative z-40 bg-white" role="dialog" aria-modal="true">
			<LayoutsDashboardNavContent />
		</div>
	</div>
</template>

<script script lang="ts">
	definePageMeta({
		layout: "landing",
	});

	import { ref } from "vue";

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
</script>
