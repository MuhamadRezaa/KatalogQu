<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 footer-copyright text-center">
        <p class="mb-0">
            Copyright {{ date('Y') }} © 
            @if(isset($userStore) && $userStore->store_name)
                {{ $userStore->store_name }}
            @else
                Store Admin Panel
            @endif
            | Powered by KatalogQu
        </p>
      </div>
    </div>
  </div>
</footer>