<div>
    <center>
        <p style="font-size:32px;margin:0;padding:0;">{{ $rack->name }}</p>
    </center>
    <center>
        <p style="font-size:32px;margin:0;padding:0; margin-bottom:4px;">Étage {{ $level }}</p>
    </center>
    <img src="data:image/png;base64, {!! base64_encode(
        QrCode::format('svg')->size(200)->generate($rack->dataInQrcode($level)),
    ) !!} ">
</div>