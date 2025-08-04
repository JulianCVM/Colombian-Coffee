import type { Data } from "./DataInterface";

const API_COLOMBIAN_COFFEE = "http://localhost:8080";

export default function getDataList(): Promise<Data> {
    // Log ANTES del fetch
    console.log('🚀 INICIANDO GETDATALIST');
    console.log('🔍 API_COLOMBIAN_COFFEE:', API_COLOMBIAN_COFFEE);
    
    const fullUrl = `${API_COLOMBIAN_COFFEE}/variedad/all`;
    console.log('🔍 Full URL construida:', fullUrl);
    
    // Agregar alert para estar SEGURO que se ejecuta
    alert(`Haciendo request a: ${fullUrl}`);
    
    return fetch(fullUrl, {
        method: "GET",
        headers: {
            "Accept": "application/json"
        }
    })
    .then(response => {
        console.log('✅ RESPUESTA RECIBIDA');
        console.log('✅ Status:', response.status);
        console.log('✅ URL final:', response.url);
        
        return response.text();
    })
    .then(textResponse => {
        console.log('📄 Texto recibido:', textResponse.substring(0, 200));
        
        if (textResponse.trim().startsWith('<')) {
            console.error('❌ ES HTML:', textResponse.substring(0, 500));
            throw new Error('Recibido HTML');
        }
        
        return JSON.parse(textResponse) as Data;
    })
    .catch(error => {
        console.error('❌ ERROR:', error);
        alert(`Error: ${error.message}`);
        throw error;
    });
}