<script>
import { useCounterStore } from '@/Stores/useCount';
const counterStore = useCounterStore();

</script>

<template>
    <footer class="p-4 mt-2 text-center">
        Footer
        {{ counterStore.count }}
    </footer>
</template>