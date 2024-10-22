<template>
  <div class="form-container">
    <h2>Crear Persona</h2>
    <form @submit.prevent="crearPersona">
      <div>
        <label for="cedula">Cédula:</label>
        <input type="text" v-model="persona.cedula" required />
      </div>

      <div>
        <label for="nacionalidad">Nacionalidad:</label>
        <select v-model="persona.nacionalidad" required>
          <option value="Venezolano">Venezolano</option>
          <option value="Extranjero">Extranjero</option>
        </select>
      </div>

      <div>
        <label for="nombres">Nombres:</label>
        <input type="text" v-model="persona.nombres" required />
      </div>

      <div>
        <label for="apellidos">Apellidos:</label>
        <input type="text" v-model="persona.apellidos" required />
      </div>

      <div>
        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" v-model="persona.fecha_nacimiento" required />
      </div>

      <div>
        <label>Sexo:</label>
        <label><input type="radio" v-model="persona.sexo" value="Masculino" /> Masculino</label>
        <label><input type="radio" v-model="persona.sexo" value="Femenino" /> Femenino</label>
      </div>

      <div>
        <label for="estadoCivil">Estado Civil:</label>
        <select v-model="persona.estado_civil" required>
          <option value="Soltero">Soltero</option>
          <option value="Casado">Casado</option>
          <option value="Divorciado">Divorciado</option>
          <option value="Viudo">Viudo</option>
        </select>
      </div>

      <div>
        <label for="estado">Estado:</label>
        <select v-model="persona.estado" @change="filtrarMunicipios" required>
          <option value="Distrito Capital">Distrito Capital</option>
          <option value="Miranda">Miranda</option>
        </select>
      </div>

      <div>
        <label for="municipio">Municipio:</label>
        <select v-model="persona.municipio" @change="filtrarParroquias" required>
          <option v-for="municipio in municipiosFiltrados" :key="municipio" :value="municipio">
            {{ municipio }}
          </option>
        </select>
      </div>

      <div>
        <label for="parroquia">Parroquia:</label>
        <select v-model="persona.parroquia" required>
          <option v-for="parroquia in parroquiasFiltradas" :key="parroquia" :value="parroquia">
            {{ parroquia }}
          </option>
        </select>
      </div>

      <div>
        <label for="direccion">Dirección:</label>
        <textarea v-model="persona.direccion" rows="3" required></textarea>
      </div>

      <div>
        <label for="telefono">Teléfonos:</label>
        <input type="text" v-model="persona.telefonos" />
      </div>

      <div>
        <label for="correo">Correo Electrónico:</label>
        <input type="email" v-model="persona.correo_electronico" required />
      </div>

      <div>
        <label for="hijos">Cantidad de Hijos:</label>
        <input type="number" v-model="persona.cantidad_hijos" min="0" />
      </div>

      <div>
        <label for="sueldo">Sueldo Actual:</label>
        <input type="number" v-model="persona.sueldo_actual" min="0" />
      </div>

      <div>
        <label for="foto">FOTO (opcional):</label>
        <input type="file" @change="onFileChange"/>
      </div>

      <button type="submit">Crear Persona</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      persona: {
        cedula: '',
        nacionalidad: 'Venezolano', // Ajustado a string directamente
        nombres: '',
        apellidos: '',
        fecha_nacimiento: '',
        sexo: 'Masculino', // Ajustado a string
        estado_civil: 'Soltero',
        estado: 'Distrito Capital',
        municipio: '',
        parroquia: '',
        direccion: '',
        telefonos: '',
        correo_electronico: '',
        cantidad_hijos: 0,
        sueldo_actual: 0,
        foto: null,
      },
      municipiosFiltrados: [],
      parroquiasFiltradas: [],
      municipios: {
        'Distrito Capital': ['Libertador'],
        Miranda: ['Chacao', 'Baruta', 'Sucre'],
      },
      parroquias: {
        Libertador: ['San Juan', 'Santa Teresa', 'El Valle'],
        Chacao: ['Chacao'],
        Baruta: ['El Cafetal', 'Las Minas'],
        Sucre: ['Petare', 'La Urbina'],
      },
    };
  },
  methods: {
    filtrarMunicipios() {
      this.municipiosFiltrados = this.municipios[this.persona.estado];
      this.persona.municipio = this.municipiosFiltrados[0] || '';
      this.filtrarParroquias();
    },
    filtrarParroquias() {
      this.parroquiasFiltradas = this.parroquias[this.persona.municipio] || [];
      this.persona.parroquia = this.parroquiasFiltradas[0] || '';
    },
    onFileChange(event) {
      this.persona.foto = event.target.files[0];
    },
    async crearPersona() {
      const formData = new FormData();
      for (const key in this.persona) {
        formData.append(key, this.persona[key]);
      }

      try {
        const response = await fetch('http://localhost:8080/personas', {
          method: 'POST',
          body: formData,
          headers: {
            'Accept': 'application/json',
          },
        });
        const data = await response.json();
        console.log('Persona creada:', data);
      } catch (error) {
        console.error('Error al crear la persona:', error);
      }
    },
  },
  mounted() {
    this.filtrarMunicipios(); // Inicializa los municipios y parroquias
  },
};
</script>

<style scoped>
/* Estilos opcionales para el formulario */
.form-container {
  max-width: 600px;
  margin: 0 auto;
}
form div {
  margin-bottom: 15px;
}
</style>
