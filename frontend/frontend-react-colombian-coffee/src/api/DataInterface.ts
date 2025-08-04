export type Data = {
    nombre_comun: string;
    nombre_cientifico: string;
    descripcion_general: string;
    porte: {
      id: number;
      porte: string;
      manejo_cultivo: string;
    };
    tamanho_del_grano: {
      id: number;
      tamanho: string;
    };
    altitud_optima_siembra: number;
    potencial_de_rendimiento: {
      id: number;
      potencial: string;
      condicion: {
        id: number;
        genetica: string;
        clima: string;
        suelo: string;
        practicas_cultivo: string;
        temperatura: string;
      };
    };
    calidad_grano_altitud: {
      id: number;
      ubicacion: {
        id: number;
        departamento: string;
        clima: string;
        suelo: string;
        altitud: string;
        temperatura: string;
        practica_cultivo: string;
      };
      calidad: string;
    };
    calidad_grano: {
      id: number;
      calidad: string;
      aroma: string;
      sabor: string;
      densidad: number;
      humedad: string;
      tueste: string;
      origen: number;
    };
    resistencia: {
      id: number;
      tipo: string;
      calidad_grano: {
        id: number;
        calidad: string;
        aroma: string;
        sabor: string;
        densidad: number;
        humedad: string;
        tueste: string;
        origen: number;
      };
      enfermedad: {
        id: number;
        nombre: string;
        efectos: string;
        gravedad: string;
        tratamiento: string;
      };
    };
    datos_agronomicos: {
      id: number;
      tiempo_cosecha: string;
      maduracion: string;
      nutricion: string;
      densidad_de_siembra: number;
      densidad: {
        id: number;
        porte: number;
        tamanho_grano: number;
        valor_densidad: number;
      };
    };
    historia: {
      id: number;
      obtenor: string;
      familia: string;
      grupo: string;
    };
    imagen?: string;
  }[];
  