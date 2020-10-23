const getProducts = ({ context }, page) => {
    return new Promise((resolve, reject) => {
        axios.get('/products', {
            params: {
                page: page
            }
        })
            .then((res) => {
                resolve(res)
            })
            .catch((err) => {
                reject(err)
            })
    });
}
const search = ({ context }, data) => {
    return new Promise((resolve, reject) => {

        axios.get('/searching-products', {
            params: {
                sku:data.sku,
                page:data.page
            }
        })
            .then((res) => {
                resolve(res);
            })
            .catch((err) => {
                reject(err);
            })
    })


}
export default {
    getProducts,
    search
}