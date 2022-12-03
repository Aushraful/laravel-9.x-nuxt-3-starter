import { Routes } from "@/config/routes";

export const useAuthCookie = () => useCookie('access_token')

export async function useUser() {
    const config = useRuntimeConfig()
    const authCookie = useAuthCookie().value
    const user = useState('user')

    if (authCookie && !user.value) {
        const { data } = await useFetch(config.api_url + `/profile`, {
            method: 'GET',
            headers: {
                Accept: 'application/json',
                Authorization: 'Bearer ' + authCookie
            },
        });

        user.value = data.value
    }

    setTimeout(() => {
        if (!authCookie || (!authCookie && user.value)) {
            user.value = null
        }
    }, 300);

    return user.value
}

export async function isEmailVerified() {
    const config = useRuntimeConfig()
    const authCookie = useAuthCookie().value

    const { data, error } = await useFetch(config.api_url + '/auth/is-email-verified', {
        method: 'GET',
        headers: {
            Accept: 'application/json',
            Authorization: 'Bearer ' + authCookie
        },
    });

    if (error._value) {

        return error._value;
    }

    return data._value;
}

export async function useLoggedIn() {
    const user = await useUser()

    if (!user?.data) {
        return false
    }

    if (user?.data?.id == null) {
        return false
    }

    return true
}

export async function registerWithEmail(formData: any) {

    const config = useRuntimeConfig()
    const url = config.api_url + "/auth/register";

    try {
        const { data, error } = await useFetch(url, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
            },
            body: formData,
            server: false,
            key: formData.email + formData.password
        })

        if (error._value) {

            return error._value.data
        }

        return data._value;
    } catch (e) {
        console.log('error: ' + e.toString())

        return e.toString()
    }
}

export async function loginWithEmail(formData: any) {

    const config = useRuntimeConfig()
    const url = config.api_url + "/auth/login";

    try {
        const { data, error } = await useFetch(url, {
            method: 'POST',
            body: formData,
            server: false,
            key: formData.email + formData.password,
            initialCache: false,
        })

        if (error._value) {
            useUnSetUser();

            return error._value.data
        }

        return data._value;
    } catch (e) {
        useUnSetUser();

        console.log('error: ' + e.toString())

        return e.toString();
    }
}

// export async function login(form: any) {

//     const url = "http://localhost:8000/api/v1/auth/login";

//     try {
//         const user = await $fetch(url, {
//             method: "post",
//             body: form,
//         });

//         if (user) {
//             useState('user').value = user?.data.user

//             useAuthCookie().value = user?.data?.access_token

//             await useRouter().push(Routes.home)
//         }

//         return true
//     } catch (e) {
//         return false
//     }
// }

export async function useLogout() {
    const config = useRuntimeConfig();
    const { $toast } = useNuxtApp();
    const access_token = useAuthCookie().value;

    const { data } = await useFetch(config.api_url + `/auth/logout`, {
        method: 'POST',
        headers: {
            Accept: 'application/json',
            Authorization: 'Bearer ' + access_token
        },
    });

    // useAuthCookie().value = '';

    // useState('user').value = null;

    useUnSetUser();

    $toast(data?._value?.message);

    await useRouter().push(Routes.login);
}

export async function verifyEmail(id: number, expires: number, signature: string) {
    const config = useRuntimeConfig();
    const { $toast } = useNuxtApp();
    const access_token = useAuthCookie().value;

    const url = config.api_url + '/auth/email/verify/' + id + '?expires=' + expires + '&signature=' + signature;


    try {
        const { data, error } = await useFetch(url, {
            method: 'GET',
        });

        if (error._value) {
            // useUnSetUser();

            // return error._value.data

            console.log(error._value);
        }

        console.log(data._value);

        return data._value;
    } catch (e) {
        useUnSetUser();

        console.log('error: ' + e.toString())

        return e.toString();
    }
}

export const useSetUser = (data: any) => {
    useState('user').value = data.user;
    // useAuthCookie().value = data?.access_token;

    const access_token = useCookie('access_token', { maxAge: data?.expires_in })
    access_token.value = data?.access_token;
}

export const useUnSetUser = () => {
    useState('user').value = null;
    useAuthCookie().value = '';
}