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
          <span v-else style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">No image</span>
        </div>
      </template>
      <template v-slot:body-cell-actions="props">
        <div style="display: flex; gap: 10px; align-items: center;">
          <q-btn color="primary" label="Editar" @click="editPerson(props.row.id)" />
          <q-btn color="negative" label="Borrar" @click="() => confirmDelete(props.row.id)" />
        </div>
      </template>
    </q-table>
    <DeleteModal ref="modal" @confirm="deletePerson" />
  </q-page>
</template>

<script lang="ts">
import { Notify } from 'quasar'
import { defineComponent, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { QTableColumn } from 'quasar';
import DeleteModal from './PersonaDeleteModal.vue';

type DeleteModalRef = {
  open: () => void;
  setId: (id: number) => void;
};

export default defineComponent({
  name: 'PersonasTable',
  components: {
    DeleteModal,
  },
  setup() {
    const router = useRouter();
    const personas = ref([]);
    const modal = ref<DeleteModalRef | null>(null); // Usamos el tipo definido aquí
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
      { name: 'actions', label: 'Acciones', align: 'center', field: 'actions', sortable: false }
    ];

    const fetchPersonas = async () => {
      try {
        const response = await fetch('http://localhost:8080/api/personas', {
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

    const editPerson = (id: number) => {
      router.push(`/update/${id}`);
    };

    const confirmDelete = (id: number) => {
      modal.value?.open(); 
      modal.value?.setId(id);
    };

    const deletePerson = async (id: number) => {
      try {
        const response = await fetch(`http://localhost:8080/api/personas/${id}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
          },
        });
        if (response.ok) {
          Notify.create({
              message: 'Se ha elimina con éxito la persona',
              color: 'green', 
              position: 'top-right',
              timeout: 2000, 
            });
          fetchPersonas();
        } else {
          console.error('Error al eliminar la persona:', response.status);
        }
      } catch (error) {
        console.error('Error al eliminar la persona:', error);
      }
    };

    onMounted(fetchPersonas);

    return {
      personas,
      columns,
      editPerson,
      confirmDelete,
      deletePerson,
      modal,
    };
  }
});
</script>
