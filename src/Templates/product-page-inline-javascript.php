<script>
    /**
    *   Função de Máscara em Javascript
    */
    function mascara(t, mask) {
        var digitou_agora = t.value.substr(t.value.length - 1);
        if (!isNaN(digitou_agora)) {
            var i = t.value.length;
            var saida = mask.substring(1,0);
            var texto = mask.substring(i);
            if (texto.substring(0,1) != saida){
                t.value += texto.substring(0,1);
            }
        } else {
            t.value = t.value.slice(0, -1);
        }
    }
</script>
