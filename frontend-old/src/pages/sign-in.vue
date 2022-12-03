<template>
	<div class="container my-0 md:my-16 h-full">
		<div
			class="w-full sm:w-2/3 md:w-96 mx-auto p-6 flex justify-center items-center flex-wrap h-full g-6 text-gray-800 dark:text-gray-300 bg-white dark:bg-gray-700 shadow rounded"
		>
			<div class="font-bold text-lg sm:text-3xl mb-5">Sign In</div>
			<div class="w-full">
				<!-- <div v-if="_error">
					<p class="bg-red-200 text-red-500 text-sm p-3 mb-5">
						{{ _error }}
					</p>
				</div> -->

				<form @submit.prevent class="space-y-3 text-sm">
					<!-- Email input -->
					<div class="">
						<input
							type="text"
							class="form-control block w-full h-9 px-4 py-2 font-normal bg-white dark:bg-gray-800 bg-clip-padding border border-solid border-gray-300 dark:border-gray-600 rounded transition ease-in-out m-0 focus:bg-white focus:border-cyan-600 dark:focus:border-cyan-600 focus:outline-none"
							placeholder="Email address"
							v-model="form.email"
						/>
					</div>

					<!-- Password input -->
					<div class="">
						<input
							type="password"
							class="form-control block w-full h-9 px-4 py-2 font-normal bg-white dark:bg-gray-800 bg-clip-padding border border-solid border-gray-300 dark:border-gray-600 rounded transition ease-in-out m-0 focus:bg-white focus:border-cyan-600 dark:focus:border-cyan-600 focus:outline-none"
							placeholder="Password"
							v-model="form.password"
						/>
					</div>

					<!-- Remember me & Forgot Password options -->
					<div
						class="w-full grid sm:flex items-center justify-center sm:justify-between"
					>
						<div class="flex items-center">
							<input
								id="remember-me"
								v-model="form.remember_me"
								type="checkbox"
								class="h-4 w-4 rounded border-cyan-300 text-cyan-600 focus:ring-cyan-500 cursor-pointer"
							/>
							<label
								for="remember-me"
								class="ml-2 block text-sm text-gray-900 dark:text-gray-300 cursor-pointer"
								>Remember me</label
							>
						</div>

						<div class="text-sm">
							<a
								href="#"
								class="font-medium text-cyan-600 hover:text-cyan-500 dark:text-cyan-600 hover:underline"
								>Forgot your password?</a
							>
						</div>
					</div>

					<!-- Submit button -->
					<button
						type="submit"
						class="inline-block px-7 py-3 bg-cyan-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-cyan-700 hover:shadow-lg focus:bg-cyan-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-cyan-800 active:shadow-lg transition duration-150 ease-in-out w-full cursor-pointer"
						data-mdb-ripple="true"
						data-mdb-ripple-color="light"
						@click="postLoginForm"
						:disabled="isLoading"
						:class="
							isLoading
								? 'cursor-not-allowed bg-opacity-25 hover:bg-opacity-25 focus:bg-opacity-25 active:bg-opacity-25'
								: ''
						"
					>
						<span v-if="isLoading">Loading...</span>
						<span v-else>Sign in</span>
					</button>

					<!-- Social Login -->
					<!-- <div class="">
						<div class="relative mt-6">
							<div class="absolute inset-0 flex items-center">
								<div class="w-full border-t border-gray-300" />
							</div>
							<div class="relative flex justify-center text-sm">
								<span
									class="bg-white dark:bg-gray-700 px-2 text-gray-500 dark:text-gray-400"
									>Or continue with</span
								>
							</div>
						</div>

						<div class="mt-6 grid grid-cols-3 gap-3">
							<div>
								<a
									href="#"
									class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 py-2 px-4 text-sm font-medium text-gray-500 hover:text-white shadow-sm hover:bg-cyan-500 active:bg-cyan-600"
								>
									<span class="sr-only">Sign in with Facebook</span>
									<svg
										class="h-5 w-5"
										aria-hidden="true"
										fill="currentColor"
										viewBox="0 0 20 20"
									>
										<path
											fill-rule="evenodd"
											d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z"
											clip-rule="evenodd"
										/>
									</svg>
								</a>
							</div>

							<div>
								<a
									href="#"
									class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 py-2 px-4 text-sm font-medium text-gray-500 hover:text-white shadow-sm hover:bg-cyan-500 active:bg-cyan-600"
								>
									<span class="sr-only">Sign in with Twitter</span>
									<svg
										class="h-5 w-5"
										aria-hidden="true"
										fill="currentColor"
										viewBox="0 0 20 20"
									>
										<path
											d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"
										/>
									</svg>
								</a>
							</div>

							<div>
								<a
									href="#"
									class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 py-2 px-4 text-sm font-medium text-gray-500 hover:text-white shadow-sm hover:bg-cyan-500 active:bg-cyan-600"
								>
									<span class="sr-only">Sign in with GitHub</span>
									<svg
										class="h-5 w-5"
										aria-hidden="true"
										fill="currentColor"
										viewBox="0 0 20 20"
									>
										<path
											fill-rule="evenodd"
											d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z"
											clip-rule="evenodd"
										/>
									</svg>
								</a>
							</div>
						</div>
					</div> -->

					<!-- Register link -->
					<div class="mt-6">
						<div class="mt-6 flex items-center">
							<div class="relative flex justify-center text-sm">
								<span
									class="bg-white dark:bg-gray-700 px-2 text-gray-500 dark:text-gray-400"
								>
									Don't have an account?
								</span>
							</div>
							<div>
								<NuxtLink
									:to="Routes.register"
									class="font-medium text-cyan-600 hover:text-cyan-500 dark:text-cyan-600 hover:underline"
								>
									<span class="sr-only">Sign up now!</span>
									<p>Sign up!</p>
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
	import { loginWithEmail, useSetUser } from "../composables/useAuth";

	interface form {
		email: string;
		password: string;
		remember_me: boolean;
	}

	const form: form = reactive({
		email: "dev@gmail.com",
		password: "",
		remember_me: false,
	});

	const isLoading = ref(false);

	const _error = ref(null);

	const errorMessage = ref("Invalid Credentials");

	const { $toast } = useNuxtApp();

	const postLoginForm = async function () {
		// if (isLoading.value) return;
		// isLoading.value = true;

		// const res = await login(form);

		// isLoading.value = false;

		// if (!res) {
		// 	hasError.value = true;
		// 	setTimeout(() => {
		// 		hasError.value = false;
		// 	}, 3000);
		// }

		if (isLoading.value) return;
		isLoading.value = true;

		const response = await loginWithEmail(form);

		isLoading.value = false;

		// console.log(response);

		if (response?.errors) {
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

		// console.log(response.data.user);

		// useState("user").value = response.data.user;

		// useAuthCookie().value = response.data?.access_token;

		await useRouter().push("/");
	};

	definePageMeta({
		layout: "landing",
		middleware: ["guest"],
	});
</script>
