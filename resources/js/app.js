import './bootstrap';

import Alpine from 'alpinejs';

// App behaviour (kept separate from the AdminLTE theme runtime in adminlte-theme.js).
import './modules/confirm-delete';

window.Alpine = Alpine;

Alpine.start();
