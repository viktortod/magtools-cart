<style>
    .document-title {
        background-color: #8080C0;
        color: white;
        text-align: center;
        font-weight: bold;
    }

    th{
        text-align: left;
        font-weight: normal;
    }

    th span, td span{
        font-weight: bold;
    }

    .list{
        margin-top: 60px;
    }

    .list caption {
        color: #8080C0;
        font-weight: bold;
    }

    .list tr th{
        background-color: #8080C0;
        color: white;
        text-align: center;
        font-weight: bold;
    }
    .list tr td{
        
        color: black;
        text-align: center;
    }

    .total-line-label {
        font-weight: bold;
        text-align: right !important;
    }

    .item td{
        border-bottom: 1px solid #8080C0;
    }
</style>

<table width="100%">
    <tr>
        <th colspan="2" class="document-title">ФАКТУРА</th>
    </tr>
    <tr>
        <th>Дата: <span><%ORDERDATE%></span></th>
        <th>Номер: <span>0000000001</span></th>
    </tr>
    <tr class="item">
        <th width="50%">Доставчик: </th>
        <th width="50%">Получател:<span><%CUSTOMERCOMPANY%></span> </th>
    </tr>
    <tr class="item">
        <td>Номер по ЕИК: </td>
        <td>Номер по ЕИК: <span><%CUSTOMERUIC%></span></td>
    </tr>
    <tr class="item">
        <td>Номер по ДДС: </td>
        <td>Номер по ДДС: <span><%CUSTOMERVAT%></span></td>
    </tr>
    <tr class="item">
        <td>Адрес: </td>
        <td>Адрес: <span><%CUSTOMERCOMPANYADDRESS%></span></td>
    </tr>
</table>
<table width="100%" class="list">
    <caption>Основание за сделката</caption>
    <tr>
        <th style="text-align: left;">Код</th>
        <th>Описание на стоката или услугата</th>
        <th>мярка</th>
        <th style="text-align: right;">количество</th>
        <th style="text-align: right;">ед. цена</th>
        <th style="text-align: right;">общо</th>
    </tr>
    <:iteration name="ORDERITEMS">
    <tr class="item">
        <td style="text-align: left;"><:ProductCode:></td>
        <td><:ProductName:></td>
        <td style="font-weight: bold;">бр.</td>
        <td style="font-weight: bold; text-align: right;"><:OrderItemQuantity:></td>
        <td style="font-weight: bold; text-align: right;"><:OrderItemSinglePrice:> лв.</td>
        <td style="font-weight: bold; text-align: right;"><:OrderItemSum:> лв.</td>
    </tr>
    <:enditeration name="ORDERITEMS">
    <tr>
        <td colspan="4"></td>
        <td class="total-line-label">данъчна основа</td>
        <td style="font-weight: bold; text-align: right;"><%OrderProductTotal%> лв.</td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td class="total-line-label">ДДС 0%</td>
        <td style="font-weight: bold; text-align: right;">0.00 лв.</td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td class="total-line-label">сума за плащане</td>
        <td style="font-weight: bold; text-align: right;"><%OrderProductTotal%> лв.</td>
    </tr>
</table>