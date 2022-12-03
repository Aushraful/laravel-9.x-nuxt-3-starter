<template>
	<div>profile</div>
</template>

<script setup lang="ts">
	import { isEmailVerified } from "@/composables/useAuth";

	const checkEmail = await isEmailVerified();

	console.log(checkEmail);

	definePageMeta({
		layout: "landing",
		middleware: ["auth"],
	});
</script>
