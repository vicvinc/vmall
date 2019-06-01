
// common utils lib
export const mapCommodityToGoods = (goods) => {
    const {
        id,
        name,
        thumbnail,
        commodity_number,
        price,
        actprice,
        commodity_stock_number,
        sales,
        commodity_detail_info,
        brief,
        commodity_disabled,
        commodity_sort
    } = goods;

    return {
        id,
        title: name,
        thumb: [thumbnail],
        remain: commodity_number,
        price: price,
        actPrice: actprice,
        soldNum: sales,
        brief: brief || '暂无简介',
        detail: commodity_detail_info || '暂无详情',
        status: commodity_disabled
    };
};

export const noop = () => {};

export const call = (key, ...args) => (context) => context[key](...args);