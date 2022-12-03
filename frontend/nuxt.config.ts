import presetIcons from '@unocss/preset-icons'

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
	srcDir: 'src',
	modules: [
		'@nuxtjs/tailwindcss',
		'@pinia/nuxt',
		'@nuxtjs/i18n',
		'@unocss/nuxt',
		'@nuxtjs/color-mode',
		'nuxt-icon',
	],
	nuxtIcon: {
		size: '24px' // default <Icon> size applied
	},
	colorMode: {
		classSuffix: ''
	},
	unocss: {
		uno: false,
		preflight: false,
		icons: true,
		presets: [
			presetIcons({
				scale: 1.2,
				extraProperties: {
					display: 'inline-block',
				},
			}),
		],
		safelist: ['i-twemoji-flag-us-outlying-islands', 'i-twemoji-flag-spain', 'i-twemoji-flag-germany'],
	},
	// localization - i18n config
	i18n: {
		locales: [
			{
				code: 'en',
				file: 'en-US.json',
			},
			{
				code: 'es',
				file: 'es-MX.json'
			},
			{
				code: 'de',
				file: 'de-DE.json'
			},
		],
		defaultLocale: 'en',
		lazy: true,
		langDir: 'locales/',
		strategy: 'prefix_except_default',
		detectBrowserLanguage: {
			useCookie: true,
			cookieKey: 'i18n_redirected',
			redirectOn: 'root', // recommended
		},
		vueI18n: {
			legacy: false,
			locale: 'en',
			fallbackLocale: 'en',
			availableLocales: ['en', 'es', 'de'],
		},
	},
	build: {
		transpile: ['@headlessui/vue'],
	},
	typescript: {
		tsConfig: {
			compilerOptions: {
				strict: true,
				types: [
					'@pinia/nuxt',
					'./type.d.ts'
				],
			},
		},
	},
	vite: {
		logLevel: 'info',
		// server: {
		// 	hmr: {
		// 		overlay: false
		// 	}
		// }
	},
	runtimeConfig: {
		private: {
			// stripeSecretKey: process.env.STRIPE_SECRET_KEY,
			// db: process.env.DATABASE_URL
		},
		public: {
			api_url: process.env.NUXT_API_URL,
			// gitHash: process.env.GITHUB_SHA,
			releaseVersion: process.env.RELEASE_VERSION,
		}
	}
})
