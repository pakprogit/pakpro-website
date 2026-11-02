<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Accept Staff Invitation | PAKPRO Admin</title>
<style>
:root{--navy:#0B2E4F;--blue:#1474BB;--lime:#D4DF22;--bg:#F3F6FA}
*{box-sizing:border-box}body{margin:0;font-family:Inter,sans-serif;background:var(--bg);color:#12263A;display:grid;place-items:center;min-height:100vh;padding:20px}
.box{background:#fff;border-radius:16px;padding:36px;width:100%;max-width:440px;box-shadow:0 10px 30px rgba(11,46,79,.1)}
.logo{display:block;margin:0 auto 24px;width:160px;height:auto}
h1{font-size:1.4rem;color:var(--navy);margin:0 0 8px;text-align:center}
p{color:#5b7189;font-size:.95rem;text-align:center;margin:0 0 24px}
label{display:block;font-weight:600;font-size:.9rem;color:var(--navy);margin-bottom:6px}
input{width:100%;padding:12px 14px;border:2px solid #c3d3e4;border-radius:10px;font:inherit;margin-bottom:16px}
input:focus{border-color:var(--blue);outline:none}
.btn{display:block;width:100%;padding:12px;background:var(--blue);color:#fff;border:0;border-radius:10px;font-weight:700;font-size:1rem;cursor:pointer}
.btn:hover{background:#0e5d97}
.error{background:#fde8e8;color:#9b1c1c;padding:10px;border-radius:8px;margin-bottom:16px;font-size:.88rem}
.reqs{font-size:.8rem;color:#6b7280;margin-top:-10px;margin-bottom:16px}
</style>
</head>
<body>
<div class="box">
  <img class="logo" src="/logo/PAKPRO%20Logo_No%20background.png" alt="PAKPRO">
  <h1>Welcome to PAKPRO Admin</h1>
  <p>You have been invited as <strong>{{ $user->email }}</strong>. Please complete your profile and set your secure password.</p>

  @if($errors->any())
    <div class="error">
      @foreach($errors->all() as $err)
        <div>{{ $err }}</div>
      @endforeach
    </div>
  @endif

  <form method="POST" action="{{ route('invitation.process', $token) }}">
    @csrf
    <div>
      <label for="name">Your full name</label>
      <input id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
    </div>
    <div>
      <label for="password">Create password</label>
      <input id="password" name="password" type="password" required autocomplete="new-password">
      <div class="reqs">Must be at least 12 characters, including upper & lower case, numbers, and symbols.</div>
    </div>
    <div>
      <label for="password_confirmation">Confirm password</label>
      <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
    </div>
    <button class="btn" type="submit">Activate Account & Set Password</button>
  </form>
</div>
</body>
</html>

