<nav class="bg-gray-800 text-white w-64 min-h-screen px-4 py-6 flex flex-col">
    <!-- Logo -->
    <div class="flex flex-col items-center mb-6">
        <a href="{{ route('dashboard') }}" class="logo-link">
            <x-application-logo class="block h-16 w-auto fill-current text-gray-200" />
        </a>
        <div class="mt-4 w-full border-t border-gray-600"></div>
    </div>

    <div class="text-center mb-6">
        <x-dropdown align="right" width="full">
            <x-slot name="trigger">
                <button class="w-full flex justify-between items-center px-4 py-2 border border-transparent text-lg leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-gray-700 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
        <div class="mt-4 w-full border-t border-gray-600"></div>
    </div>

    <!-- Navigation Links 
    class="h-6 w-6 mr-3" 
    -->
    <div class="space-y-4 flex-1">
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Dashboard -->
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFCUlEQVR4nO2aS2xVVRSGzxVaMZFWWqUoYNSJgsQBBEckvmInFgVMq8TEmYamDTpQopjQ6owQGx3qwBhjxPiISUU0MUYMSDDGapTS4gPwMbMSFTVYSz+zev8dl7fncR/nXqrhT86ge++z9lpnr8e/9m0UncP/FMBFwB3ALuAtYAw4Cfyp56TG9mjN7UBrNBcANAObgbeBKSrHlIy+22RFZ8GA84GtwPdOqdPAPmAA2AisBBYBTTJ4kcY2as0HOqmA74D+hhkE3Ap86RT4DNhiiiasv8CehLk2oFcyAsz9bq73KTwNTGvDz4EuoJDx3lfA0Yw1BWA9cFiybY+h3E8HuAQ45FzoYXOZMt+dQZlrm4Bt2sNwEGiv2QAJvxwYl+CvgdVuznx9a62GAA8AO9zfa4BjztWW53ESwYhPgMVubh7wm9xgXYoMy2h7U+bXSYbJOs+NdwAj2vtI1SejmDjkjGiJWWMnYhipapOijKDsQMxcq5v/sKqYUWAHd1qcsGYBMAp8kxX0KUF+TDIWJKzpcG42VE2KnVbQrc5YO99Or0IbSk9+fsaatao502WnZgk+qi/wUDRHADzigj/bxVSxQ52Y+VLAxY1QNg1iB+aChr5yFgfa0aWxB/X3K8CyqAGgmPJ3KPbec+NGSg3fpp6KCGCgHQUXL6c0/jNwWZ2UN5fuAd4BzjjKcrAkOZinGHqijJxv2FIyvgx4Cfgit0r7j+zrgKeACWbj3VKqb26luT1p/cSUMlUsAcxR+VaRxY9JxnNxNMg+JDCpZ1ZtswUbJOD9Ohpg1OMZVXGcuz4LDOtvS7GDGXIO+DgunbSuLbbC1qj8UuAxFdaAM3KbzaLyb2j8NHBPGTIf1/qdcZPWgho25GRAC/B8Sedo2WYQuMJV7Y809xNwQ5myN+md4bjJ0CytyMGIDvUh4Su/DHSWkMIVjnpYmr2mAvnX6r3xuMmQNdpdb3CVnoooCPCCZL1mDDpm/iZdRiBiGsvlXFoOejSFAq13f4xK4frnmULj6Dsqkql8KOGjdMTM3ev2ej2pDXYf8wenx7gzbua0ozIM2a0jt+fNStgt8KtkLSkpZgOuVX7Su1qCnIJiN+ixuxxD/uVatcBloVeBS40NAC9qbCqTK2Ugy7UC412ZJaiMja52MeBxKjb3Vy5/leSNNSL9LhfR/EV+vhO4MifZm9LSbyiIqVV1LgB4Iq0gBoq8L5rjoNi/G25LIo1/KXu1xczPiyVp9VO2xfZMCPRAGhcmvbxXlvaWjHcqGfzuU2q9QDHT/aE9O0vm+hPjwy26K6axut9lnU+BCxtgyELtFXBfTGPVndXq2q24Yb3GuoHjdhFR7jVpTsY0ac/jQWnXapzI1MUd3eFGKp4Fih/5SJzrp71gVy6GbdEcAbBdOo2W/YGBW9wF3Zq6a5mtz/Xugu7GSl+23ydQzzCLxTYKwBLFhGFXNQKa9fsEukhu+A+XFC8pQvbaX3XM6sYiBJhdBS3NXdv0kxhxcdGWB/kLxlgqXJubtukxccIZkc8Np04m8BsLukfrkZopuvN21+Ttr/kkEjYZch3eqIhmIQfZBRW7McmeFhuvXx2z3yfchogy9FXTWYoA9iv+AkYrTrE1nk6f7qkCJuUKg2p8Vsklm/W0a+xOXbAdENsOsJjoPStsQgr2qLv0SpWLSV1sdM8ZOkSRsXappR2W+024f6qZUPYb1pquxH7iHKL/Pv4GhXe3NuxivygAAAAASUVORK5CYII=" class="h-6 w-6 mr-3">
            {{ __('Dashboard') }}
        </a>
        <a href="{{ route('ventas.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('ventas.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Ventas -->
            <img class="h-6 w-6 mr-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACAUlEQVR4nO2YsU5UQRSGh2AMWNCsNdjDC2whDfSsASp5AO1IMDF2EAKuCT6A2EJLAj0UGAu1lRoCAhU2RJZdTD4zYTae3Ozd7Mw993I3ma/c7P+ff+7cOWd2jYlEIpFSAKwDDf5zDXwFZk3ZAQZc4DTWTNkB1hI7kKRq+glgBNgRC9g0/QZQpXzcAqu9LuAJ8Jfyce2zC0eUj58+C9gWwlfmgQBeixxbPsI3Qvgp15RdsE1E5FjyEU4L4TfzQADfRY4pH2FFCG+AR4GTvRONXoakrelqt6n0vABncCrE4wqT3aujAOPi+6de4Z3BrjBYUJrsPjuwIDS7IQtYFgYbpmCAj6L+cohBTRjs55KyC8CBqD8TYjAmDH7bd9wUBPfn6UrUHw01kiZj6klTAJ6pPLzENtaCTMLqvlB5fTMfpPC6KyoNJHMrC6+7J+q+zGI0kWmYhNc98xmi3YwGgT/C7KlqUsVrTCr2MicM5zKZ9VZvXvUi6S5obeztcEglaQesN/BD9Z8R15ObwvQQeA4MZzZ3WC9gEvgi6jSDB1gS+2OC4llUCS8W8Q64KyD4HfBWNXyirX4GToCWYugWcOy8w9tmpJ8AHgMfgAvgHKjbz/LSqeMKJ6nnpVPHPcEkl3np1HHbn+RXXjp1Ul6F93np1HGHse6eqO8hrvvqIpFIxJSGf/HJZVvrMADfAAAAAElFTkSuQmCC">
            {{ __('Ventas') }}
        </a>

        <a href="{{ route('products.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('products.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Productos -->
            <img class="h-6 w-6 mr-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA4ElEQVR4nO3WPQ6CQBDF8a30DnpD/DgmaqF4FYP930BGCp0V1gKmeL+EZAveJCxheSmJyF+ANXAEzsDTrm69B1YRs1+ALXAnr+nuiZTN7civYW+3zx1aKuuy1zrVLkLWBVwKBp4iZF1AWzCwjZB1FQ58RMi67Kibqo6QdQGHgoFVhKzLjsHuvB5zzRyhs2ez7MfUjAzbRMpmdU9ttaC2D7G1dTWhZiySFZkTqvGoxqMa71CNT6rxPdX4HNX4pBo/QDVeZH6oxqMaj2q8QzU+qcb3VONzVOOTavwA1XgRSSNeUYHOaYf2EtAAAAAASUVORK5CYII=">
            {{ __('Productos') }}
        </a>

        <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('categories.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Categorías -->
            <img class="h-6 w-6 mr-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABgUlEQVR4nO2Y223DMAxF9eUNanSWZgdnqvSxVo0s0HxkgbhrnMKFDAiK5IceNVPw/sQmCVonkklZxqhUqk0COmAgX2OOrnbeqAo9bNKtdt6opkiTKT9PrbyrAoEz0AdiFu3SQHrgMxCzaBcFkiOxIGxfZmJB+o3LTCbIVokCQauWkTUjORILglYtYTPy0EsLrVpG1ozkSALIjX/yYdUVgrl5n7rHGnlVDyPKnnYcvaVVPG9Ueoriafr7QvfAE/BlTVfgeYP9V2ZJ3gMb4AP4tjP1Ntqc2KjfzePeAy1wsdfjb2v9a+1JIO/c69WJjfpnQHIg2lSQ6eV8AQ72enBio/4ZkGQIk7FpnAZ6cAYa6tZ3/oUZSYVoU0HGNe/r5MRG/TMgORCXVJDGDnawW4NT4GUP+mMgJSA2g+TIz7Nr1aoEskvVair0kWQIk1G1avWRP69aQ4U+skvVGkr3kRIQYvrIHnutpnQf2aVq5WgGJGXrfnXsq0H0FMWTnqKoVEaOfgBzU7WjszNWFgAAAABJRU5ErkJggg==">
            {{ __('Categorías') }}
        </a>

        <a href="{{ route('clientes.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('clientes.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Clientes -->
            <img class="h-6 w-6 mr-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEWUlEQVR4nO2ZW6hVVRSGd6e8dTHrUGIdFSwrUztBiVYkZD0YgkIPllmRJyk0u4kRRg/aRZ+6KGVaYooKekpMIdRjQjfCC0V2O2j1YEej1LxUSpr6xaB/4WSz1t5zzbm37Yf9w+LA2f/4xxhzrTXnGGMVCnXUUUdVAVwJjAdmAnOAV4BngRHAOYVaBnA20AJ8S2n8CAxPsW8ExgDPAa8BLwOPAVecySR6AZ87we4BWoFXgam67M7s0O9HgTeAm4EmYDlwLCPxk8BcoFO1k+jhBLgTGAWclcFt0Eq7+Nv52wa8DkxT8m8BB/T7H8A7QO9qJbJYjr4ALvTgWzLXAk8Ce2X7C9Azg98EfO8kvg8YWOkk+gAngH+A5gD7fs6Kj/TYQNrE/TLrrgcBmCzhVREaM6SxwoPbDfhV/FtDfaYJr5boQxEaA6Txkyd/rvhPh/pME90s0WGR27a96KeAcz34j8jnwlCfaaI/SPSaSJ3D0unhwZ0g7pIYn8Wi7RK9OlLniHS6e3CfEHdejM9i0Y8lOjxC4yJpHPHkzxH/mVCfaaIrJHpPhMZQaXztyd8q/m2hPtNErRA0zI7QsFPc8KYH93ydWcd9NoY8QYxUEJsiNNZKY7wHd4RTzjSF+kwTvtOpg3KX50Bn4JA0RnnaLBF/QlDQGaIfJS9eSMlgNsB0aXzoabNS/PuCgi6z/TZHaDRL4zsP7otqAay+6xPqM034XQXREqExURqtZXjddfpbEs+H+ssSf0BB7LL+IcB+qmwN95fhjhZvXVTQJeqk97RSVmY05LBtcEqTVaZVhv+BuE9VJPgMJ1/JiXfDAwyWTbsH925x/wQujQ7Yo2yYlcNmtmzme3APiDslOtgyjm6QI3N4iQf/YuB32dziwf9N3LLa0QDelzM7WxpL8C4ANoi70VP7Z/GrM3gocna504ZmNlrWu4hzyHdmxX+zMMOAigZdwqFNUgw3leDYBMW7tTUA62VjrXW3QrUBfONxR5IevSOH7nWq59AM7V6gS8UCT3FoAzrD4BKc3uLsDdhQ2jkN2wBmAX0rErzjqCfwV7mX0oZ4OkCP5a2XgE7Ag8A2JyErWZbFzg3cw227hNd78FuTwxC4MaKzXOrMjE9oHNs5RGygdXbq2NCj1cvDrtGZ2lsAi4DrI6ad86Vj2OS1IVgDBdwlA3tEkon5Yp9xTtF58rZsE3wKjA2ZvAO3OwfnolLErlYiONUqGuMsAAbldVy0i81z3i/DbisOgfNyag3R02ELPCSti2vRN48E9lg8bqOc0AQyNoFHnXct2ZnGBX4dOD3MsBUB1jjCm8tNzSsB4A7gM8dvK/Cw57Uw2UgSsS7AJ/rnfiulq51ASkL2JFjpHoLjiYh9xzN0AFed6SSK3qEO54PQAt/LjPtrEGY7ytD/KwknmWGKxeZZl+UxfEEr0FaoEQAbFdNLeYy2yGhSoUYATFJM2/IYHaR2cThPIrWOroE3to46ChXAv41Q2V+Zy2u8AAAAAElFTkSuQmCC">
            {{ __('Clientes') }}
        </a>

        <a href="{{ route('inventarios.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('inventarios.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Inventario -->
            <img class="h-6 w-6 mr-3" src="data:image/png;base64,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">
            {{ __('Inventario') }}
        </a>

        <a href="{{ route('proveedores.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('proveedores.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Proveedores -->
            <img class="h-6 w-6 mr-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACsUlEQVR4nO2ZTYiNURjHD6Px/THKFAs1zUIsJomyMooiTGyEBRtWslGzYaEsEDY2ypTIBmk2mo2Umub6GEKyoVj5CIkRaXzOT0/3f3OT677nfc9558X9L+97nt/5PZ33ds8517lGGmkk9wAtwGagB7gNPAE+AiWgyRU9QCtwFPhA7WxzRQ7QCbyoEh4E9gNrgQ5gpz5/A5wFtgLNrkgB1gFfJXoFWPKbMU3AwC+r8xhY7IoQYAHwXmKHgbF1xk/T6l1SzTtj5GdcI1VCZzzrxliNaq+60QywVCJvgRkp6icDL8XojGOZTORI5ZXKwDggxvGwdn4S9hthWZaBsUKMO2Ht/CQqr0VrBkabGENh7fwkPklifAZGsxhfwtr5STySRFsGxiwxnoa185PolcTGDIzVYvSHtfOT2CKJ3gyMC2LsCmvnJ7FHEjcyMGzvZdkb1s5P4rUkUu+XgJViPA9r5ydhZwxLSwbGRDGGw9r5SfRLYlMGxnIx7oa185PYIYlXQFeK+vU6PVr2xbFMJjIOuCiReynqH6r2PDAljqXfdty+9N+AmSm2Js+M4YoQfv4WdHvUHFJNjytKgFVV55I5CcbP1snQssgVKcA5iQ3WeH6NeCmFbGRChVrjedS4kEnSSNAJXSTuf98I5avUeinlsiLAPDE/R2pkIHojuhJ9IObJ6BOG5gLtwDFbBfHu17rfKlwjlO9wu4A+4Ls4I8BpYGrwCevEmwtMAnbbJUHVezsMnAIWBp8wYRJz7VLaztPaqldiu9ZuuwEJPqFnEnGB6cDlqgauA2vS7FZHrRHKR9CbGmc3ihuiThiLC5zQGLuEmxt9whhcYL4OSvYvVEf0CWNxgYN63pfLhLG4wC09357LhLG4wBCRkncjpX+ikRhpNFLUFflbXln3h0aife/s0PUDc5csHgxn56IAAAAASUVORK5CYII=">
            {{ __('Proveedores') }}
        </a>

        <a href="{{ route('formapago.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('formapago.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Forma de Pago -->
            <img class="h-6 w-6 mr-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACOElEQVR4nO3Xy2pUMRjA8SgoWgStl7Z24UYQXIhgXYoW+gAuFUUKPoK4tw+hO1/AtaAbF9Iq1qoobb2Bd/CGuhAv4MafRCPEYWY60zo2B88fDpOcDDn5n3xfkhNCTU3vUTHCfyMSCkctUtUZwXi6HqartHrHIpUgdCBSypsfb1HvTCQUjlqkMNQzUvUZwTo8+wsr5VSTZ3XT91QpIpNLFJlckkipqEUKQ0nJXlWRyTbPHME+3MS1noj0CqzGUUw3CN/GiuJFsBETeJ0N/nNW3t9hP8sngiHcywZ9B8fRjy/p3u6iRRokYviMZm1RJjLdRX//XgQDmM8kNjW0x5mJHClWJEnMtZEYTW2v4gIQShTBIO6mLm/FRG+S+FEuMtFl3z9Z8A9LYKJJOLWSiPcj93+3+7WidUyvRE6lPrZgtk04bcBMan+A4cVIREKvWKxEUWBrltidhNNQKA1/zkRkrIoSA9lMfE2/H7CnahLzWTgN42ImM1YVibnGxE4n2/NZmBWd2IMLbHbDWZhJ3xpvcRmrQkUk+rNw+t4wM/H43rd8o29+im0lEd9+5Dk+pvI5bO/mPNUzYg6khG0lETe7G6k9LsWXUjnm0dpQCjichchImx17NjtuxK+/naEkcDITeYRt6f56XM8kDuJbqh8LpYEXWahEnmAvHmcSu/Ay1c+GEsH7NMAD2SaY8wlvUvkq1oQSwRnNiQvAhWypvYLNoVTQh9N4h6c4gUPZjh43wR1YudxjrQkF8ANp6AtoX2VF0wAAAABJRU5ErkJggg==">
            {{ __('Forma de Pago') }}
        </a>

        <a href="{{ route('compras.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('compras.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Compras -->
            <img class="h-6 w-6 mr-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACcUlEQVR4nO2ZPWgUQRiGN2g0jcHGwkIIqOm0EVIoBAuVdJ42Khi0EdNIMBYiNhYKURRt1UpICmMVEUHtLBSsRMSfnI2IlT8RG4WIjwzOJq/n3e7O7MxygX1gWPaY7/2+9+7mu525JKmpqampKQuwEzidMQ4DPZ7am4AJcy1daDuAAWCBfEYTD4B3Nn7OJz6kgeue+ov4xBcCGAbOA5MtY0ryP+5aA50ANkj+T0nFBoB9wH2g4ZPbCPQA36WGdQUWbPqdz8PM67iwgRXANzv3s5cBK/RMkg7nzD2FGxMZWptl3scyBm6J0PECn0CzYPFzwMYMrYbMfVjGwBkRuuYRv4hj3FkJveqaV4X2itCDCg1MS+gx17wqNChCHyo08FxCt7vmVaGVwE8r9Bvod4xvuv4S87cD/RADa72KF8EXIjbkGGsW9smsBRutA4ngjAgeKS2Yn68RpAOJ4DkRnAxSZRUdKAU4IIKzSWQI1YFEcKsINoNUmZ3vleTbEUKwD/hlBc11D7Ar0rgsxX8FVod6V4o+IoTkUpDirYHZiou/B/SGNGA2OCnvgUeRxg2zDwhWuBg4KgZuJ8sNYEgMvE2WG8Aq4IuYuALsjtCFBmKauFjB4l3I2/mVMdBru0NsTkQxIEb2224RowvdBNZENVDTLQD9wDbXXVrLudOgHV6Hx94AY7LtM9cxx/j1wFNZuE/Ma/Eq/v/xOn06TTH3Wxw07rTpPjNxK19KPt6h/Y07aMy3iZ+PW/lS8kMdDBx00HjTJv513Mr/3eC8bElu7vscNEZD/YnihTmrAS4Ad+1/C85nN8CI3f+aMRKn0pqamqSb+QOwirlMm068OQAAAABJRU5ErkJggg==">
            {{ __('Compras') }}
        </a>

        <a href="{{ route('vendedores.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('vendedores.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Vendedores -->
            <img class="h-6 w-6 mr-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAAB00lEQVR4nO2WuUpDQRiFrxY2Lo0L6CPYWVkmptDCwgXBvIGdIKjBzqUT3yIKdoq+gWIhaFxSWAiiL+ASRbTQTwbOhSFMbsY4txByYCDMnPnPmX/+/HeiqIkm/huAPmADuADeNErAOtCbtvgMUKE2XoDpNMW/JbQHZIB2jSywr7UvYCqNtFcksJTAK4jzDPSENLARn9yDeyDuWkgDlwqa8eCOiFsKaeBVQTs8uJ3iVkIaePyFga74HxHSwKmCZj24OXHPQxpYUNB9D+6huKshDXQBDwpcSOCtiPMEdAczYAAMW8V4oGrv0MhZJzeNaCJKA8CQen8tPKUpPg7cOkRNhzwzd+5Ke0z6i3ALsGkJXgHzwKD5Djj4edO6axlQW8//xsCWYnwAc0BrAjevD1YZGAN2LOPbmiuLU98EMGmJ+7ThPgnUQ9nOkhNAG3CvDXNulnPfmGV6EejXWNKcwahPoFnrzmum3bEvTvuiY21Za0WfQLsiz3sKV6Nf8yfAsX4PVJOihIB34gz+0cAxcNSIgXdxOn0MWPtMtTtfTtaLqf4VNApTYFYRLuvUAxL/9C7CRmCe5cA19XETX1FQVDUik4miJVrUnH8jiho3Ea4VBzCUWO0/2n3WUQKbqpgAAAAASUVORK5CYII=">
            {{ __('Vendedores') }}
        </a>

        <a href="{{ route('cotizaciones.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('cotizaciones.index') ? 'bg-gray-900' : '' }} transition duration-300 ease-in-out transform">
            <!-- Icono de Cotizaciones -->
            <img lass="h-6 w-6 mr-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAuUlEQVR4nO2TQQrCMBBFR9eCF9CdvYwbb+Tau7jVm3gNRQ+gTwZTiBBCNHFSS96q8Kf8l04q0mgMCYwYvoD8iCZAzgqI7DJ1z+MQkMBcLBvfF6gm0AMs3dj1k6yIALAAjm5sn5qVFOg5A6vUrKTATU8XKohlxQRy+R+BEN5MB5zI4GsBYA1ccsqjAiG897bA3T3rZZuJBbzzAHbA1KRc8cr1N9uINbzQS9eZlyvAAZhLLYBJtfKGGPAE4Uvp8G8Mn0sAAAAASUVORK5CYII=">
            {{ __('Cotizaciones') }}
        </a>
    </div>
</nav>