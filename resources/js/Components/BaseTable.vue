<script setup lang="ts" generic="D, T extends string = string">
interface Props {
    columns: Record<T, string>;
    data: {
        [key in T]?: D;
    }[];
}

defineProps<Props>();
</script>
<template>
    <div class="overflow-x-auto rounded-lg bg-white shadow-md dark:bg-gray-900">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th
                        v-for="(col, key) in columns"
                        :key="key"
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-300 uppercase"
                    >
                        {{ col }}
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                <tr v-for="(row, rowKey) in data" :key="rowKey">
                    <td v-for="(_col, colKey) in columns" :key="colKey" class="px-6 py-4 whitespace-nowrap">
                        <slot :name="`cell-${colKey}`" :row="row" :value="row[colKey]">
                            {{ row[colKey] }}
                        </slot>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
