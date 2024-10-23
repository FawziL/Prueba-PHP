<template>
  <q-page>
    <h1>Personas Registradas</h1>
    <PersonasTable />
  </q-page>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import PersonasTable from '../components/PersonasTable.vue';

export default defineComponent({
  name: 'PersonasPage',
  components: {
    PersonasTable
  }
});
</script>
