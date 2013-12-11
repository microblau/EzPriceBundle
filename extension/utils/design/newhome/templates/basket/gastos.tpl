<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8>
</head>
<body>
    {def $gastosNode = fetch('content', 'node', hash( 'node_id', ezini( 'GastosEnvio', 'NumeroNodo', 'gastos.ini')))}
    <img src={$gastosNode.data_map.image.content.original.url|ezroot} width="{$gastosNode.data_map.image.content.original.width}" height="{$gastosNode.data_map.image.content.original.height}" alt="Gastos de Envío" />
</body>
</html>