import { defineStore, acceptHMRUpdate } from 'pinia'

export const useAuthStore = defineStore({
    id: 'auth-store',
    state: () => {
        const access_token = useCookie("access_token");
        let has_access_token = false;

        if (access_token.value) {
            has_access_token = true
        }

        return {
            has_access_token: has_access_token
        }
    },
    actions: {
        login() {
            const access_token = useCookie("access_token");
            const auth = useAuth();

            if (access_token.value) {
                this.has_access_token = true;
                auth.value.isAuthenticated = true;

                navigateTo('/')
            }
        },

        logout() {
            const access_token = useCookie("access_token");
            const auth = useAuth();

            if (access_token.value) {
                access_token.value = '';
            }

            this.has_access_token = false;
            auth.value.isAuthenticated = false

            navigateTo('/login')
        }
    },
    getters: {
        isAuthenticated: state => state.has_access_token,
    },
})

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useAuthStore, import.meta.hot))
}