<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>MyShop Admin/Vendor Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
    theme: {
      extend: {
        colors: {
          ink: '#14181D',
          inkline: '#232932',
          paper: '#EDEEEA',
          paperline: '#D8D6CE',
          brass: '#B8912E',
          brassdeep: '#8B6F1F',
          muted: '#5B6169',
        },
        fontFamily: {
          display: ['"Space Grotesk"', 'sans-serif'],
          body: ['Inter', 'sans-serif'],
        },
      },
    },
  }
    </script>
    <style>
        :root {
            box-sizing: border-box;
        }

        * {
            box-sizing: inherit;
        }

        html,
        body {
            height: 100%;
        }

        input:focus-visible,
        button:focus-visible,
        a:focus-visible {
            outline: 2px solid #B8912E;
            outline-offset: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                transition: none !important;
            }
        }
    </style>
</head>

<body class="font-body bg-paper text-ink">

    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Left identity panel -->
        <div
            class="relative md:w-[42%] bg-ink text-paper flex flex-col justify-between overflow-hidden px-10 py-12 md:px-14 md:py-16">
            <svg class="absolute inset-0 w-full h-full opacity-[0.07]" preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="48" height="48" patternUnits="userSpaceOnUse">
                        <path d="M 48 0 L 0 0 0 48" fill="none" stroke="#EDEEEA" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>

            <div class="relative">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 border border-brass flex items-center justify-center">
                        <div class="w-2.5 h-2.5 bg-brass"></div>
                    </div>
                    <span class="font-display font-semibold text-lg tracking-tight">MyShop</span>
                </div>
            </div>

            <div class="relative max-w-sm">
                <h1 class="font-display text-3xl md:text-[2.4rem] leading-[1.15] font-semibold">
                    One entrance for everyone who runs the shop.
                </h1>
                <p class="mt-5 text-[15px] leading-relaxed text-paper/70">
                    Staff and vendor accounts share this door. Where you land
                    after signing in depends on what you're set up to manage.
                </p>
            </div>

            <div class="relative flex items-center gap-6 text-sm text-paper/50">
                <span>Admin console</span>
                <span class="w-1 h-1 rounded-full bg-paper/30"></span>
                <span>Vendor portal</span>
            </div>
        </div>

        <!-- Right form panel -->
        <div class="flex-1 flex items-center justify-center px-6 py-16 md:px-16">
            <div class="w-full max-w-[380px]">

                <h2 class="font-display text-2xl font-semibold text-ink">
                    Sign in to MyShop
                </h2>
                <p class="mt-2 text-sm text-muted">
                    Use the email tied to your staff or vendor account.
                </p>

                <form class="mt-10 space-y-7" method="POST" action="{{route('staff.login')}}">
                    @csrf
                    @if($errors->any())
                    <div class="p-4 mb-4 text-sm text-fg-danger-strong rounded-base bg-danger-soft" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div>
                        <label for="email" class="block text-sm font-medium text-ink mb-2">
                            Email address
                        </label>
                        <input id="email" type="email" name="email" placeholder="name@yourco.com"
                            class="w-full bg-transparent border-0 border-b border-paperline pb-2.5 text-[15px] text-ink placeholder:text-muted/60 focus:border-brass transition-colors" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-medium text-ink">
                                Password
                            </label>
                            <a href="#" class="text-sm text-brassdeep hover:text-brass transition-colors">
                                Forgot it?
                            </a>
                        </div>
                        <input id="password" name="password" type="password" placeholder="••••••••••"
                            class="w-full bg-transparent border-0 border-b border-paperline pb-2.5 text-[15px] text-ink placeholder:text-muted/60 focus:border-brass transition-colors" />
                    </div>

                    <label class="flex items-center gap-2.5 text-sm text-muted cursor-pointer select-none">
                        <input type="checkbox"
                            class="w-4 h-4 border-paperline text-brass focus:ring-brass rounded-[3px]" />
                        Keep me signed in on this device
                    </label>

                    <button type="submit" name="submit"
                        class="w-full bg-ink text-paper text-[15px] font-medium py-3 hover:bg-brassdeep transition-colors">
                        Sign in
                    </button>

                </form>

                <p class="mt-10 text-sm text-muted">
                    Looking for the customer sign-in? It lives at a
                    <a href="#" class="text-brassdeep hover:text-brass transition-colors">separate address</a>.
                </p>
            </div>
        </div>

    </div>

</body>

</html>