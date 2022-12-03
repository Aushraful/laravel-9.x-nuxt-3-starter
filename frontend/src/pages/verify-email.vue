<template>
	<div>test</div>
</template>

<script setup lang="ts">
	import { verifyEmail } from "@/composables/useAuth";
	const route = useRoute();
	const routeQuery = route.query;

	interface params {
		// id: string;
		// expires: string;
		// hash: string;
		// signature: string;
		// key: string;
	}

	// const expires = routeQuery.expires;
	// const hash = routeQuery.hash;
	// const id = routeQuery.id;
	// const signature = routeQuery.signature;
	// const key: any = routeQuery.key;

	const params = reactive({
		// id: id,
		// expires: expires,
		// hash: hash,
		// signature: signature,
		// key: key,
	});

	// console.log(id);

	const isLoading = ref(false);

	const config = useRuntimeConfig();

	// const { data } = await useFetch(
	// 	config.api_url + `/auth/email/verify/` + params.id,
	// 	{
	// 		method: "GET",
	// 		headers: {
	// 			Accept: "application/json",
	// 		},
	// 	}
	// );

	// console.log(data);
	// if (isLoading.value) return;
	// isLoading.value = true;

	// const response = verifyEmail(params);

	// isLoading.value = false;

	// console.log(response);

	// async function verifyEmail() {
	// 	if (isLoading.value) return;
	// 	isLoading.value = true;

	// 	const response = await verifyEmail(params);

	// 	isLoading.value = false;

	// 	console.log(response);
	// }

	// const id: number = 47;
	// const expires: number = 1666972932;
	// const signature: string =
	// 	"37963d45c8c61ba593eb004df5b9ef5c0ad631a5aa6f5f625cd15c765ba755f8";

	const id: number = routeQuery.id;
	const expires: number = routeQuery.expires;
	const signature: string = routeQuery.signature;

	await verifyEmail(id, expires, signature);

	definePageMeta({
		layout: "landing",
	});
</script>
