<?php
declare(strict_types=1);

/**
 * Maps video type slug to [WHERE clause, display label].
 * Used by portfolio, products, and style pages.
 */
function video_type_switch(string $t): array {
    $t = strtolower($t);
    switch ($t) {
        case 'whiteboard':   return ['WHERE whiteboard=true', 'Whiteboard'];
        case 'animation':    return ['WHERE animation=true', 'Animation'];
        case 'presentation': return ['WHERE Presentation=true', 'Presentation'];
        case 'demo':         return ['WHERE demo=true', 'Demo'];
        case 'product':     return ['WHERE product=true', 'Product'];
        case 'typography':  return ['WHERE Typography=true', 'Typography'];
        case 'elearning':   return ['WHERE elearning=true', 'eLearning'];
        case 'specialty':   return ['WHERE specialty=true', 'Specialty'];
        case 'logo':        return ['WHERE logo=true', 'Logo'];
        case 'motion':      return ['WHERE motion=true', 'Motion'];
        case 'testimonials': return ['WHERE testimonials=true', 'Testimonials'];
        case '3d':          return ['WHERE 3d=true', '3D'];
        case 'viral':       return ['WHERE viral=true', 'Viral'];
        case 'app':         return ['WHERE app=true', 'App'];
        default:            return ['WHERE 1=1', 'Video'];
    }
}
