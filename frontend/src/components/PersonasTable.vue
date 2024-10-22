<template>
  <q-page>
    <q-table
      :rows="personas"
      :columns="columns"
      row-key="id"
      flat
      bordered
    >
      <template v-slot:body-cell-foto="props">
        <q-img
          v-if="props.row.foto"
          :src="props.row.foto"
          style="width: 50px; height: 50px"
          contain
        />
        <span v-else>No image</span>
      </template>
    </q-table>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';
import { QTableColumn } from 'quasar';

export default defineComponent({
  name: 'PersonasTable',
  setup() {
    const personas = ref([]);
    const columns: QTableColumn[] = [
      { name: 'id', required: true, label: 'ID', align: 'left', field: 'id', sortable: true },
      { name: 'nacionalidad', label: 'Nacionalidad', align: 'left', field: 'nacionalidad' },
      { name: 'cedula', label: 'Cédula', align: 'left', field: 'cedula' },
      { name: 'nombre_completo', label: 'Nombre Completo', align: 'left', field: 'nombre_completo' },
      { name: 'estado', label: 'Estado', align: 'left', field: 'estado' },
      { name: 'municipio', label: 'Municipio', align: 'left', field: 'municipio' },
      { name: 'parroquia', label: 'Parroquia', align: 'left', field: 'parroquia' },
      { name: 'telefonos', label: 'Teléfonos', align: 'left', field: 'telefonos' },
      { name: 'correo_electronico', label: 'Correo Electrónico', align: 'left', field: 'correo_electronico' },
      { name: 'foto', label: 'Foto', align: 'center', field: 'foto' }
    ];

    const fetchPersonas = async () => {
   try {
     const response = await fetch('http://localhost:8080/personas', {
       method: 'GET', // Asegúrate de especificar el método
       headers: {
         'Content-Type': 'application/json', // Agrega encabezados si es necesario
       },
     });
     if (!response.ok) {
       throw new Error(`HTTP error! status: ${response.status}`);
     }
     const data = await response.json();
     personas.value = data;
     console.log(data);
   } catch (error) {
     console.error('Error al obtener las personas:', error);
   }
};

    onMounted(fetchPersonas);

    return {
      personas,
      columns
    };
  }
});
</script>

<style scoped>
/* Opcional: agrega estilos personalizados para la tabla */
</style>
