<template>
	<div class="container my-0 md:my-16 h-full">
		<div
			class="w-full sm:w-2/3 md:w-96 mx-auto p-6 flex justify-center items-center flex-wrap h-full g-6 text-gray-800 dark:text-gray-300 bg-white dark:bg-gray-700 shadow rounded"
		>
			<div class="font-bold text-lg sm:text-3xl mb-5">Sign Up</div>
			<div class="w-full">
				<div v-if="_error" v-for="error in _error">
					<p class="bg-red-200 text-red-500 text-sm p-3 mb-5">
						{{ error }}
					</p>
				</div>

				<form @submit.prevent class="space-y-3">
					<!-- Full Name input -->
					<div class="">
						<input
							type="text"
							class="form-control block w-full h-9 px-4 py-2 font-normal bg-white dark:bg-gray-800 bg-clip-padding border border-solid border-gray-300 dark:border-gray-600 rounded transition ease-in-out m-0 focus:bg-white focus:border-cyan-600 dark:focus:border-cyan-600 focus:outline-none"
							placeholder="Full Name"
							v-model="formData.name"
						/>
					</div>

					<!-- Email input -->
					<div class="">
						<input
							type="text"
							class="form-control block w-full h-9 px-4 py-2 font-normal bg-white dark:bg-gray-800 bg-clip-padding border border-solid border-gray-300 dark:border-gray-600 rounded transition ease-in-out m-0 focus:bg-white focus:border-cyan-600 dark:focus:border-cyan-600 focus:outline-none"
							placeholder="Email address"
							v-model="formData.email"
						/>
					</div>

					<!-- Password input -->
					<div class="">
						<input
							type="password"
							class="form-control block w-full h-9 px-4 py-2 font-normal bg-white dark:bg-gray-800 bg-clip-padding border border-solid border-gray-300 dark:border-gray-600 rounded transition ease-in-out m-0 focus:bg-white focus:border-cyan-600 dark:focus:border-cyan-600 focus:outline-none"
							placeholder="Password"
							v-model="formData.password"
						/>
					</div>

					<!-- Confirm Password input -->
					<div class="">
						<input
							type="password"
							class="form-control block w-full h-9 px-4 py-2 font-normal bg-white dark:bg-gray-800 bg-clip-padding border border-solid border-gray-300 dark:border-gray-600 rounded transition ease-in-out m-0 focus:bg-white focus:border-cyan-600 dark:focus:border-cyan-600 focus:outline-none"
							placeholder="Confirm Password"
							v-model="formData.password_confirmation"
						/>
					</div>

					<!-- Submit button -->
					<button
						type="submit"
						class="inline-block px-7 py-3 bg-cyan-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-cyan-700 hover:shadow-lg focus:bg-cyan-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-cyan-800 active:shadow-lg transition duration-150 ease-in-out w-full cursor-pointer"
						data-mdb-ripple="true"
						data-mdb-ripple-color="light"
						@click="postRegistrationForm"
						:disabled="isLoading"
						:class="
							isLoading
								? 'cursor-not-allowed bg-opacity-25 hover:bg-opacity-25 focus:bg-opacity-25 active:bg-opacity-25'
								: ''
						"
					>
						<span v-if="isLoading">Loading...</span>
						<span v-else>Sign up</span>
					</button>

					<!-- Login link -->
					<div class="mt-6">
						<div class="mt-6 flex items-center">
							<div class="relative flex justify-center text-sm">
								<span
									class="bg-white dark:bg-gray-700 px-2 text-gray-500 dark:text-gray-400"
								>
									Already have an account?
								</span>
							</div>
							<div>
								<NuxtLink
									:to="Routes.login"
									class="font-medium text-cyan-600 hover:text-cyan-500 dark:text-cyan-600 hover:underline"
								>
									<span class="sr-only">Sign in now!</span>
									<p>Sign in!</p>
								</NuxtLink>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script setup lang="ts">
	import { Routes } from "@/config/routes";
	import { registerWithEmail, useSetUser } from "../composables/useAuth";

	interface formData {
		name: string;
		email: string;
		password: string;
		password_confirmation: string;
	}

	const formData: formData = reactive({
		name: "",
		email: "",
		password: "",
		password_confirmation: "",
	});

	const isLoading = ref(false);
	const _error = ref(null);
	const { $toast } = useNuxtApp();

	const postRegistrationForm = async function () {
		if (isLoading.value) return;

		isLoading.value = true;

		const response = await registerWithEmail(formData);

		isLoading.value = false;

		console.log(formData);

		if (response?.errors) {
			if (response?.errors?.name) {
				$toast(response.errors.name[0], "warning");
			}

			if (response?.errors?.email) {
				$toast(response.errors.email[0], "warning");
			}

			if (response?.errors?.password) {
				$toast(response.errors.password[0], "warning");
			}

			return;
		}

		if (response.status == false) {
			_error.value = response.message;
			$toast(_error.value, "error");

			return;
		}

		$toast(response.message, "success");

		useSetUser(response.data);

		await useRouter().push("/");
	};

	definePageMeta({
		layout: "landing",
		middleware: ["guest"],
	});
</script>
