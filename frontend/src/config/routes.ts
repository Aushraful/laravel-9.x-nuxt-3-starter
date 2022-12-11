export const Routes = {
	home: '/',
	register: '/sign-up',
	login: '/sign-in',
	logout: '/sign-out',
	forgotPassword: '/forgot-password',
	resetPassword: '/reset-password',
	profile: '/profile',
	settings: '/settings',

	dashboard: '/dashboard',

	user: {
		...routesFactory('/users'),
	},
	dashboard_category: {
		...routesFactory('/categories'),
	},
	attribute: {
		...routesFactory('/attributes'),
	},
	attributeValue: {
		...routesFactory('/attribute-values'),
	},
	order: {
		...routesFactory('/orders'),
	},
	orderStatus: {
		...routesFactory('/order-status'),
	},
	orderCreate: {
		...routesFactory('/orders/create'),
	},
};

function routesFactory(endpoint: string) {
	return {
		list: `${endpoint}`,
		create: `${endpoint}/create`,
		editWithoutLang: (slug: string, shop?: string) => {
			return shop
				? `/${shop}${endpoint}/${slug}/edit`
				: `${endpoint}/${slug}/edit`;
		},
		edit: (slug: string, language: string, shop?: string) => {
			return shop
				? `/${language}/${shop}${endpoint}/${slug}/edit`
				: `${language}${endpoint}/${slug}/edit`;
		},
		translate: (slug: string, language: string, shop?: string) => {
			return shop
				? `/${language}/${shop}${endpoint}/${slug}/translate`
				: `${language}${endpoint}/${slug}/translate`;
		},
		details: (slug: string) => `${endpoint}/${slug}`,
	};
}
