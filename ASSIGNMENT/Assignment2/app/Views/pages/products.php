<div>
    <h1>{page_title} - {company_name}</h1>

    {if $is_sale}
    <div class="alert">Sedang Ada Promo!</div>
    {endif}

    <table border="1">
        <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status</th>
        </tr>
        {products}
        <tr>
            <td>{name}</td>
            <td>Rp {price}</td>
            <td>{stock}</td>
            <td>{status}</td>
        </tr>
        {/products}
    </table>
</div>