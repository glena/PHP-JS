<?php

namespace Glena\PhpJs\Transpilers;

class TranspilerFactory {

  public static function build(string $className) {

    switch ($className) {
      case \PhpParser\Node\Stmt\Function_::class:
        return new FunctionStatementTranspiler();
        break;
      case \PhpParser\Node\Expr\Assign::class:
        return new AssignExpressionTranspiler();
        break;
      case \PhpParser\Node\Expr\FuncCall::class:
        return new FuncCallExpressionTranspiler();
        break;
      case \PhpParser\Node\Stmt\Return_::class:
        return new ReturnStatementTranspiler();
        break;
      case \PhpParser\Node\Expr\BinaryOp\Plus::class:
        return new PlusOperatorTranspiler();
        break;
      case \PhpParser\Node\Expr\Variable::class:
        return new VariableExpressionTranspiler();
        break;
      case \PhpParser\Node\Arg::class:
        return new ArgNodeTranspiler();
        break;
      case \PhpParser\Node\Scalar\LNumber::class:
        return new LNumberScalarTranspiler();
        break;
      case \PhpParser\Node\Expr\BinaryOp\Concat::class:
        return new ConcatOperatorTranspiler();
        break;
      case \PhpParser\Node\Scalar\String_::class:
        return new StringScalarTranspiler();
        break;
      case \PhpParser\Node\Param::class:
        return new ParamNodeTranspiler();
        break;
      case \PhpParser\Node\Stmt\If_::class:
        return new IfStatementTranspiler();
        break;
      case \PhpParser\Node\Stmt\Else_::class:
        return new ElseStatementTranspiler();
        break;
      case \PhpParser\Node\Stmt\ElseIf_::class:
        return new ElseIfStatementTranspiler();
        break;
      case \PhpParser\Node\Expr\BinaryOp\Equal::class:
        return new EqualOperatorTranspiler();
        break;
      case \PhpParser\Node\Expr\ConstFetch::class:
        return new ConstFetchExpressionTranspiler();
        break;
      case \PhpParser\Node\Name::class:
        return new NameNodeTranspiler();
        break;
      case \PhpParser\Node\Stmt\For_::class:
        return new ForStatementTranspiler();
        break;
      case \PhpParser\Node\Expr\BinaryOp\Smaller::class:
        return new SmallerOperatorTranspiler();
        break;
      case \PhpParser\Node\Expr\PostInc::class:
        return new PostIncExpressionTranspiler();
        break;
      case \PhpParser\Node\Expr\PostDec::class:
        return new PostDecExpressionTranspiler();
        break;
      case \PhpParser\Node\Stmt\Nop::class:
        return new NopStatementTranspiler();
        break;
      case \PhpParser\Node\Stmt\While_::class:
        return new WhileStatementTranspiler();
        break;
      case \PhpParser\Node\Expr\BinaryOp\Greater::class:
        return new GreaterOperatorTranspiler();
        break;
      case \PhpParser\Node\Expr\BinaryOp\GreaterOrEqual::class:
        return new GreaterOrEqualOperatorTranspiler();
        break;
      case \PhpParser\Node\Expr\BinaryOp\SmallerOrEqual::class:
        return new SmallerOrEqualOperatorTranspiler();
        break;
      case \PhpParser\Node\Expr\Array_::class:
        return new ArrayExpressionTranspiler();
        break;
      case \PhpParser\Node\Stmt\Foreach_::class:
        return new ForEachExpressionTranspiler();
        break;
      
      default:
        throw new \Exception ($className . " transpiler not defined");
        break;
    }

  }
  
}



