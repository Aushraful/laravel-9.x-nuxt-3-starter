<template>
	<div class="">
		<img
			:src="product.image"
			:alt="product.title"
			class="h-full w-full bg-transparent duration-300"
		/>
		<div class="p-3">
			<h1 class="w-full py-2 text-center font-bold mt-auto">
				{{ product.title }}
			</h1>
			<div class="flex items-center justify-between">
				<span>{{ product.price }}</span>
				<button
					class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold px-3 py-1 rounded-lg hover:cursor-pointer"
				>
					Add to cart
				</button>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ["product"],
	};
</script>
