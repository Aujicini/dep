#ifndef ZKEY_H
#define ZKEY_H

#include "defs.h"

class Board;

class ZKey {
 public:
  ZKey();

  ZKey(const Board &board);

  static void init();

  U64 getValue() const;

  void movePiece(Color, PieceType, unsigned int, unsigned int);

  void flipPiece(Color, PieceType, unsigned int);

  void flipActivePlayer();

  void setFromPawnStructure(const Board&);

  bool operator==(const ZKey &);

 private:
  U64 _key;

  static U64 PIECE_KEYS[2][6][64];

  static U64 WHITE_TO_MOVE_KEY;

  static const unsigned int PRNG_KEY;
};

#endif
