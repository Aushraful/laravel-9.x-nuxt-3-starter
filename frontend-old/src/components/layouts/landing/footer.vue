<template>
	<div>
		<footer
			class="h-auto border-t text-sm border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800"
		>
			<!-- <h1 class="text-white text-4xl text-center p-20">Footer</h1> -->

			<div class="grid px-3 sm:px-6 md:px-6 lg:px-20 pt-8 space-y-8">
				<div
					class="w-full grid grid-cols-1 md:grid-cols-5 md:space-x-3 space-y-3 md:space-y-0"
				>
					<div class="w-full space-y-3 md:col-span-2">
						<div class="grid space-y-3">
							<div>
								<img
									:src="siteSettings.logo.src"
									:alt="siteSettings.logo.alt"
									class="w-60 h-10"
								/>
								<p>
									{{ siteSettings.description }}
								</p>
							</div>
							<div class="space-y-1">
								<h1 class="font-bold text-md">{{ $t("text-contact-us") }}</h1>
								<ul class="text-xs space-y-1">
									<li class="space-x-2">
										<Icon
											name="bx:phone-call"
											class="text-primary text-lg"
										></Icon>
										<span>{{ siteSettings.contact.phone }}</span>
									</li>
									<li class="space-x-2">
										<Icon
											name="clarity:email-line"
											class="text-primary text-lg"
										></Icon>
										<span>{{ siteSettings.contact.email }}</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div
						class="w-full md:col-span-3 grid md:flex space-y-3 md:space-y-0 justify-between"
					>
						<div
							class="space-y-3"
							v-for="(menu, index) in siteSettings.footer.menu"
							:key="index"
						>
							<h1 class="font-bold text-md">
								{{ $t("text-" + menu.title) }}
							</h1>
							<ul class="text-xs space-y-2">
								<li v-for="(link, linkIndex) in menu.links" :key="linkIndex">
									<NuxtLink :href="link.href">
										{{ $t("text-" + link.name) }}
									</NuxtLink>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div
					class="grid space-y-6 sm:space-y-0 sm:flex sm:items-center sm:justify-between content-center"
				>
					<div class="w-full grid">
						<div
							class="w-full flex flex-wrap items-center justify-center md:justify-start space-x-3"
						>
							<span
								v-for="(social_media, index) in siteSettings.social_medias"
								:key="index"
							>
								<img
									:src="social_media.src"
									:alt="social_media.alt"
									:title="social_media.title"
									class="h-5"
								/>
							</span>
						</div>
					</div>

					<div class="w-full grid">
						<div
							class="text-right w-full flex items-center justify-center md:justify-end space-x-3"
						>
							<span
								v-for="(payment_method, index) in siteSettings.payment_methods"
								:key="index"
							>
								<img
									:src="payment_method.src"
									:alt="payment_method.alt"
									:title="payment_method.title"
									class="h-5"
								/>
							</span>
						</div>
					</div>
				</div>
				<div
					class="grid text-xs font-bold items-center space-y-3 md:space-y-0 pb-6"
				>
					<div class="text-center">
						© {{ siteSettings.footer.copyright.year }}
						{{ siteSettings.footer.copyright.name }} |
						{{ $t(siteSettings.footer.copyright.text) }}
					</div>
				</div>
			</div>
		</footer>
	</div>
</template>

<script>
	export default {
		props: ["siteSettings"],
	};
</script>
