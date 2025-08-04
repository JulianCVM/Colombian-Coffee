import type { Data } from "./DataInterface";

const API_COLOMBIAN_COFFEE = "http://localhost:8080";

export default function getDataList(): Promise<Data> {
    const fullUrl = `${API_COLOMBIAN_COFFEE}/variedad/all`;

    return fetch(fullUrl, {
        method: "GET",
        headers: {
            "Accept": "application/json"
        }
    })
    .then(response => response.text())
    .then(textResponse => {
        if (textResponse.trim().startsWith('<')) {
            throw new Error('Recibido HTML');
        }

        return JSON.parse(textResponse) as Data;
    })
    .catch(error => {
        throw error;
    });
}
