<template>
    <q-dialog v-model="showModal">
      <q-card>
        <q-card-section>
          ¿Estás seguro de que deseas eliminar esta persona?
        </q-card-section>
        <q-card-actions>
          <q-btn color="negative" label="Cancelar" @click="cancel" />
          <q-btn color="primary" label="Confirmar" @click="confirmDelete" />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref } from 'vue';
  
  export default defineComponent({
    name: 'DeleteConfirmationModal',
    emits: ['deleted'],
    setup(props, { emit }) {
      const showModal = ref(false);
      const idToDelete = ref<number | null>(null);
  
      const open = (id: number) => {
        showModal.value = true;
        idToDelete.value = id; // Guarda el ID de la persona a borrar
      };
  
      const cancel = () => {
        showModal.value = false;
        idToDelete.value = null;
      };
  
      const confirmDelete = async () => {
        if (idToDelete.value !== null) {
          try {
            await fetch(`http://localhost:8080/personas/${idToDelete.value}`, {
              method: 'DELETE',
              headers: {
                'Content-Type': 'application/json',
              },
            });
            emit('deleted', idToDelete.value); // Emitir evento para que el componente padre actualice la lista
          } catch (error) {
            console.error('Error al eliminar la persona:', error);
          } finally {
            cancel(); // Cierra el modal
          }
        }
      };
  
      return {
        showModal,
        open,
        cancel,
        confirmDelete,
      };
    },
  });
  </script>
  