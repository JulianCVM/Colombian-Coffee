import type { Data } from "./DataInterface";
// A la importacion se le define que es un type

const API_COLOMBIAN_COFFEE = "http://localhost:8080";

// 
export default function getDataList(): Promise<Data> {
    return fetch(`${API_COLOMBIAN_COFFEE}/variedad`, {
        "method": "GET",
        "headers": {
            "Content-Type": "application/json"
        }
    })
    .then(response => {
        return response.json();
    })
    .then(response => {
        console.log('Habemus datos ', response)
        return response as Data
    })
}