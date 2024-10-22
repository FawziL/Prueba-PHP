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
        <div>
          <q-img
            v-if="props.row.foto"
            :src="props.row.foto"
            style="width: 120px; height: 100px;"
            contain
          />
          <span v-else style="width: 100px; height: 100px;display: flex; align-items: center; justify-content: center;">No image</span>
        </div>
      </template>
      <template v-slot:body-cell-actions="props">
        <div style="display: flex; gap: 10px;align-items: center;"> <!-- Espacio entre los botones -->
          <q-btn color="primary" label="Editar" @click="editPerson(props.row.id)" />
          <q-btn color="negative" label="Borrar" @click="deletePerson(props.row.id)" />
        </div>
      </template>
    </q-table>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router'; // Importar useRouter
import { QTableColumn } from 'quasar';

export default defineComponent({
  name: 'PersonasTable',
  setup() {
    const router = useRouter(); // Usar el router
    const personas = ref([]);
    const columns: QTableColumn[] = [
      { name: 'id', required: true, label: 'ID', align: 'left', field: 'id', sortable: true },
      { name: 'foto', label: 'Foto', align: 'center', field: 'foto' },
      { name: 'nacionalidad', label: 'Nacionalidad', align: 'left', field: 'nacionalidad' },
      { name: 'cedula', label: 'Cédula', align: 'left', field: 'cedula' },
      { name: 'nombre_completo', label: 'Nombre Completo', align: 'left', field: 'nombre_completo' },
      { name: 'estado', label: 'Estado', align: 'left', field: 'estado' },
      { name: 'municipio', label: 'Municipio', align: 'left', field: 'municipio' },
      { name: 'parroquia', label: 'Parroquia', align: 'left', field: 'parroquia' },
      { name: 'telefonos', label: 'Teléfonos', align: 'left', field: 'telefonos' },
      { name: 'correo_electronico', label: 'Correo Electrónico', align: 'left', field: 'correo_electronico' },
  
      { name: 'actions', label: 'Acciones', align: 'center', field: 'actions', sortable: false } // Nueva columna para acciones
    ];

    const fetchPersonas = async () => {
      try {
        const response = await fetch('http://localhost:8080/personas', {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
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

    const editPerson = (id:number) => {
      router.push(`/update/${id}`);
    };

    const deletePerson = (id:number) => {
      // Implementa la lógica para eliminar la persona
      console.log('Delete ID:', id);
    };

    onMounted(fetchPersonas);

    return {
      personas,
      columns,
      editPerson,
      deletePerson
    };
  }
});
</script>

<style scoped>
/* Opcional: agrega estilos personalizados para la tabla */
</style>
