/*
処理で使えるちょっとした値やメソッドを定義する場所
*/

export const OK = 200;
export const CREATED = 201;
export const INTERNAL_SERVER_ERROR = 500;
export const UNPROCESSABLE_ENTITY = 422;

export function getCookieValue(searchKey) {
    if (typeof searchKey === "undefined") {
        return "";
    }

    let val = "";

    document.cookie.split(";").forEach((cookie) => {
        const [key, value] = cookie.split("=");

        if (key === searchKey) {
            return (val = value);
        }
    });

    return val;
}
