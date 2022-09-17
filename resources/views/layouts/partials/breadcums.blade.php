<div class="section-header-breadcrumb">

    <div class="breadcrumb-item active">Dashboard</div>
    <?php $segments = ''; ?>
    @foreach (Request::segments() as $segment)
        <?php $segments .= $segment; ?>
        <div class="breadcrumb-item">{{ $segment }}</div>
    @endforeach
</div>
