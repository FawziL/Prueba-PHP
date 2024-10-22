<template>
    <q-dialog v-model="isOpen">
      <q-card>
        <q-card-section>
          ¿Estás seguro de que deseas eliminar esta persona?
        </q-card-section>
        <q-card-actions style="display: flex; justify-content: center;">
          <q-btn label="Cancelar" @click="close" />
          <q-btn label="Confirmar" color="negative" @click="confirm" />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref } from 'vue';
  
  export default defineComponent({
    name: 'DeleteModal',
    setup(_, { emit }) {
      const isOpen = ref(false);
      let personId: number | null = null; // Para almacenar el ID de la persona a eliminar
  
      const open = () => {
        isOpen.value = true;
      };
  
      const close = () => {
        isOpen.value = false;
      };
  
      const setId = (id: number) => {
        personId = id; // Guarda el ID de la persona a eliminar
      };
  
      const confirm = () => {
        emit('confirm', personId); // Emitir el evento de confirmación
        close(); // Cerrar el modal
      };
  
      return {
        isOpen,
        open,
        close,
        setId,
        confirm,
      };
    },
  });
  </script>
  