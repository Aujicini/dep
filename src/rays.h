#ifndef RAYS_H
#define RAYS_H

#include "defs.h"

namespace Rays {
namespace detail {

extern U64 _rays[8][64];
};

enum Dir {
  NORTH,
  SOUTH,
  EAST,
  WEST,
  NORTH_EAST,
  NORTH_WEST,
  SOUTH_EAST,
  SOUTH_WEST
};

void init();

U64 getRay(Dir, int);
};

#endif
