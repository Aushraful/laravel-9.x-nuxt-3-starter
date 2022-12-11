<template>
	<div class="relative p-4 rounded bg-gray-100 dark:bg-gray-700">
		<div class="sm:flex sm:items-center">
			<div class="sm:flex-auto">
				<h1 class="text-xl font-semibold dark:text-gray-300">Categories</h1>
				<p class="mt-2 text-sm text-gray-700 dark:text-gray-500">
					A list of all the users in your account including their name, title,
					email and role.
				</p>
			</div>
			<div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
				<button
					type="button"
					class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
				>
					Add user
				</button>
			</div>
		</div>
		<div class="mt-8 flex flex-col">
			<div class="overflow-x-auto">
				<div class="inline-block min-w-full py-2 align-middle">
					<div
						class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg border"
					>
						<div
							v-if="selectedPeople.length > 0"
							class="absolute top-0 left-12 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16"
						>
							<button
								type="button"
								class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30"
							>
								Delete all
							</button>
						</div>
						<table
							class="min-w-full table-fixed divide-y divide-gray-300 dark:devide-gray-500"
						>
							<thead class="text-gray-900 dark:text-gray-300">
								<tr>
									<th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
										<input
											type="checkbox"
											class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
											:checked="
												indeterminate || selectedPeople.length === people.length
											"
											:indeterminate="indeterminate"
											@change="
												selectedPeople = $event.target.checked
													? people.map((p) => p.id)
													: []
											"
										/>
									</th>
									<th
										scope="col"
										class="hidden px-3 py-3.5 text-left text-sm font-semibold lg:table-cell"
									>
										Name
									</th>
									<th
										scope="col"
										class="hidden px-3 py-3.5 text-left text-sm font-semibold sm:table-cell"
									>
										Email
									</th>
									<th
										scope="col"
										class="px-3 py-3.5 text-left text-sm font-semibold"
									>
										Role
									</th>
									<th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
										<span class="sr-only">Edit</span>
									</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-gray-200 dark:divide-gray-500">
								<tr
									v-for="person in people"
									:key="person.id"
									:class="[
										selectedPeople.includes(person.id) &&
											'bg-gray-100 dark:bg-gray-900',
									]"
								>
									<td class="relative w-12 px-6 sm:w-16 sm:px-8">
										<div
											v-if="selectedPeople.includes(person.id)"
											class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"
										></div>
										<input
											type="checkbox"
											class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6"
											:value="person.id"
											v-model="selectedPeople"
										/>
									</td>
									<td
										class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium sm:w-auto sm:max-w-none sm:pl-6"
									>
										{{ person.name }}
										<dl class="font-normal lg:hidden">
											<dt class="sr-only">Title</dt>
											<dd class="mt-1 truncate text-gray-700">
												{{ person.title }}
											</dd>
											<dt class="sr-only sm:hidden">Email</dt>
											<dd class="mt-1 truncate text-gray-500 sm:hidden">
												{{ person.email }}
											</dd>
										</dl>
									</td>
									<td
										class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell"
									>
										{{ person.title }}
									</td>
									<td
										class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell"
									>
										{{ person.email }}
									</td>
									<td class="px-3 py-4 text-sm text-gray-500">
										{{ person.role }}
									</td>
									<td
										class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
									>
										<div class="flex">
											<a href="#" class="text-indigo-600 hover:text-indigo-900"
												><UiIconsAdd /><span class="sr-only"
													>, {{ person.name }}</span
												>
											</a>
											<a href="#" class="text-indigo-600 hover:text-indigo-900"
												><UiIconsEdit /><span class="sr-only"
													>, {{ person.name }}</span
												>
											</a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup lang="ts">
	import { ref, computed } from "vue";

	const people = [
		{
			id: 1,
			name: "Lindsay Walton",
			title: "Front-end Developer",
			email: "lindsay.walton@example.com",
			role: "Member",
		},
		{
			id: 2,
			name: "Lindsay Walton",
			title: "Front-end Developer",
			email: "lindsay.walton@example.com",
			role: "Member",
		},
		{
			id: 3,
			name: "Lindsay Walton",
			title: "Front-end Developer",
			email: "lindsay.walton@example.com",
			role: "Member",
		},
		{
			id: 4,
			name: "Lindsay Walton",
			title: "Front-end Developer",
			email: "lindsay.walton@example.com",
			role: "Member",
		},
		// More people...
	];

	const selectedPeople = ref([]);
	const checked = ref(false);
	const indeterminate = computed(
		() =>
			selectedPeople.value.length > 0 &&
			selectedPeople.value.length < people.length
	);

	definePageMeta({
		layout: "dashboard",
	});
</script>
